<?php  

require "../conexao.php";
session_start();

if(isset($_POST['btn'])){


	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_SPECIAL_CHARS);
	$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT);

	//verificar se nome já foi cadastrado
	$cmd = $pdo->prepare("SELECT id FROM funcionarios WHERE nome = :nome");
	$cmd->bindValue(":nome",$nome);
	$cmd->execute();

	if($cmd->rowCount() > 0) 
	{
		header('location: ../../cad-funcionario&erro_nome');
	}
	else 
	{
		$sql = $pdo->prepare("INSERT INTO funcionarios (nome, morada, telefone) VALUES(:nome, :morada, :telefone)");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":morada", $morada);
        $sql->bindValue(":telefone", $telefone);
		
		if($sql->execute())
		{
			header('location: ../../cad-funcionario');
			$_SESSION['msg'] = "cadastrado com sucesso";
		}

		else
		{
		header('location: ../../cad-funcionario');
		$_SESSION['msg'] = "erro ao cadastrar";
		}
		
	}

	
}
