<?php  
session_start();
require '../conexao.php';

if(isset($_POST['btn'])){ 
	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_SPECIAL_CHARS);
	$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_SPECIAL_CHARS);
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

	$sql = $pdo->prepare("UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade WHERE id = :id ");
	$sql->bindParam(":nome", $nome);
	$sql->bindParam(":preco", $preco);
	$sql->bindParam(":quantidade", $quantidade);
	$sql->bindParam(":id", $id);

	if($sql->execute()) { 
		header('Location: ../../stock');
 }
	else { 
		header('Location: ../../stock');
	 }
 }


?>