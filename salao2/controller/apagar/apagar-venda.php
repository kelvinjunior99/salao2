<?php  
session_start();
require 'conexao.php';

if(isset($_POST['deletar'])):
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

	$sql = "DELETE FROM pagamento WHERE id = '$id' ";

	if(mysqli_query($conexao, $sql)):
		header('Location: ../lista-venda');
		$_SESSION['excluir'] = "exluido com sucesso";

	else:
		header('Location: ../lista-venda');
		$_SESSION['excluir'] = "erro ao exluir";
	endif;

	endif;

?>