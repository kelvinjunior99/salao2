<?php 
session_start();
include "../conexao.php";


if(isset($_POST['btn']))
{
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $produto = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_SPECIAL_CHARS);
    $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_INT);
    $valor_pago = filter_input(INPUT_POST, 'valor_pago', FILTER_SANITIZE_NUMBER_INT);

        $sql = $pdo->prepare("INSERT INTO anuladas (produto, quantidade,  preco, valor_pago) VALUES(:produto, :quantidade, :preco, :valor_pago)");
        $sql->bindValue(":produto", $produto);
        $sql->bindValue(":quantidade", $quantidade);
        $sql->bindValue(":preco", $preco);
        $sql->bindValue(":valor_pago", $valor_pago);
        
        if($sql->execute())
        {
            $enviar = $pdo->query("SELECT quantidade FROM produtos WHERE nome = '$produto' ");
            if($enviar->execute())
            {
                $dados = $enviar->fetch(PDO::FETCH_ASSOC);
                $quantidade = ($dados['quantidade'] + $quantidade);
        
                $sq = $pdo->query("UPDATE produtos SET quantidade = '$quantidade' WHERE nome = '$produto'");
                
                if($sq->execute())
                {
                    $dl = $pdo->prepare("DELETE FROM vendas WHERE id = :id");
                    $dl->bindValue(":id", $id);
                    $dl->execute();
                }
            }

            $_SESSION['msg'] = "Venda anulada com sucesso";
            header('location: ../../lista-venda');
        }
        
        else
        {
            $_SESSION['msg'] = "erro ao anular venda";
            header('location: ../../lista-venda');

        }
}


?>