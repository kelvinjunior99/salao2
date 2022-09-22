<?php  
session_start();
require '../conexao.php';

if(isset($_POST['btn'])){ 
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

	$sql = $pdo->prepare("DELETE FROM produtos WHERE id = :id");
	$sql->bindParam(":id", $id);

	if($sql->execute()){ 
		header('Location: ../../stock');
		$_SESSION['excluir'] = "exluido com sucesso";
	}

	else { 
		header('Location: ../../stock');
		$_SESSION['excluir'] = "erro ao exluir";
	 }

	 }
?>