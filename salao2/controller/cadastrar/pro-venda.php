<?php 
include "../conexao.php";


if(isset($_POST['btn']))
{
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $produto = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_SPECIAL_CHARS);
    $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);
    $preco_total = filter_input(INPUT_POST, 'preco_total', FILTER_SANITIZE_NUMBER_INT);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_INT);
    $cliente = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_SPECIAL_CHARS);
    $valor_pago = filter_input(INPUT_POST, 'valor_pago', FILTER_SANITIZE_NUMBER_INT);
    $troco = filter_input(INPUT_POST, 'troco', FILTER_SANITIZE_NUMBER_INT);

        $sql = $pdo->prepare("INSERT INTO vendas (produto, quantidade, preco_total, preco, valor_pago, troco, cliente) VALUES(:produto, :quantidade, :preco_total, :preco, :valor_pago, :troco, :cliente)");
        $sql->bindValue(":produto", $produto);
        $sql->bindValue(":quantidade", $quantidade);
        $sql->bindValue(":preco_total", $preco_total);
        $sql->bindValue(":preco", $preco);
        $sql->bindValue(":valor_pago", $valor_pago);
        $sql->bindValue(":troco", $troco);
        $sql->bindValue(":cliente", $cliente);
        
        
        if($sql->execute())
        {
            $enviar = $pdo->prepare("SELECT quantidade FROM produtos WHERE id = :id ");
            $enviar->bindValue(":id", $id);
            if($enviar->execute())
            {
                $dados = $enviar->fetch(PDO::FETCH_ASSOC);
                $quantidade = ($dados['quantidade'] - $quantidade);
        
                $sq = $pdo->prepare("UPDATE produtos SET quantidade = :quantidade WHERE  id = :id ");
                $sq->bindValue(":quantidade", $quantidade);
                $sq->bindValue(":id", $id);
                $sq->execute();
            }

            $_SESSION['msg'] = "cadastrado com sucesso";
            header('location: ../../lista-venda');
        }
        
        else
        {
            $_SESSION['msg'] = "erro ao cadastrar venda";
            header('location: ../../lista-venda');

        }
}


?>