<?php  

require 'conexao.php';

if(isset($_POST['btn'])):
	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
	$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

	$sql = "UPDATE pagamento SET nome = '$nome', valor = '$valor' WHERE id ='$id' ";

	if(mysqli_query($conexao, $sql)):
		header('Location: ../lista-venda');

	else:
		header('Location: ../lista-venda');
	endif;
endif;


?>