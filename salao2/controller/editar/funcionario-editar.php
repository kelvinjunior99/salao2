<?php  

require '../conexao.php';

if(isset($_POST['btn'])){ 
	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_SPECIAL_CHARS);
	$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

	$sql = $pdo->prepare("UPDATE funcionarios SET nome = :nome, morada = :morada, telefone = :telefone WHERE id = :id ");
	$sql->bindParam(":nome", $nome);
	$sql->bindParam(":morada", $morada);
	$sql->bindParam(":telefone", $telefone);
	$sql->bindParam(":id", $id);

	if($sql->execute()){ 
		header('Location: ../../lista-funcionarios');
	 }

	else { 
		header('Location: ../../lista-funcionarios');
	 }
 }


?>