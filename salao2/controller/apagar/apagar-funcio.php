<?php  
session_start();
require "../conexao.php";

if(isset($_POST['btn'])){ 
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

	$sql = $pdo->prepare("DELETE FROM funcionarios WHERE id = :id ");
	$sql->bindValue(":id", $id);

	if($sql->execute())
	{ 
		header('Location: ../../lista-funcionarios');
		$_SESSION['excluir'] = "exluido com sucesso";
	 }

	else {
		header('Location: ../../lista-funcionarios');
		$_SESSION['excluir'] = "erro ao exluir";
	 }

 }

?>