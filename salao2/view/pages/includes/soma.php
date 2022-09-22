<?php 
include_once "controller/conexao.php";

$pr = $pdo->prepare("SELECT sum(quantidade) as total FROM produtos");
$pr->execute();
$pr = $pr->fetch(PDO::FETCH_ASSOC);
$pr['total'];

$func = $pdo->prepare("SELECT count(*) as total FROM funcionarios");
$func->execute();
$func = $func->fetch(PDO::FETCH_ASSOC);
$func['total'];


$vd = $pdo->prepare("SELECT count(*) as total FROM vendas");
$vd->execute();
$vd = $vd->fetch(PDO::FETCH_ASSOC);
$vd['total'];

//--------------------------------

$venda = $pdo->prepare("SELECT sum(preco_total) as total FROM vendas");
$venda->execute();
$venda = $venda->fetch(PDO::FETCH_ASSOC);
$venda['total'];


?>