<?php  

require "../conexao.php";
session_start();

if(isset($_POST['btn'])){


	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_SPECIAL_CHARS);
	$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);

	//verificar se nome já foi cadastrado
	$cmd = $pdo->prepare("SELECT id FROM produtos WHERE nome = :nome");
	$cmd->bindValue(":nome",$nome);
	$cmd->execute();

	if($cmd->rowCount() > 0) 
	{
		header('location: ../../cad-produto&erro_nome');
	}
	else 
	{
		$sql = $pdo->prepare("INSERT INTO produtos (nome, preco, quantidade) VALUES(:nome, :preco, :quantidade)");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":quantidade", $quantidade);
        $sql->bindValue(":preco", $preco);
		
		if($sql->execute())
		{
			header('location: ../../cad-produto');
			$_SESSION['msg'] = "cadastrado com sucesso";
		}

		else
		{
		header('location: ../../cad-produto');
		$_SESSION['msg'] = "erro ao cadastrar";
		}
		
	}

	
}
