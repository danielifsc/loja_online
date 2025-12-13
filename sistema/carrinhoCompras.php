<?php
session_start()

?>

<?php


include 'conexao.php';
$sql = $pdo->query("SELECT produto.id, produto.categoria, produto.preco, produto.desconto_usados, 
            produto.preco * estoque.quantidade_disponivel as subtotal,
            produto.preco * produto.desconto_usados as comDesc,
            produto.nome AS nome_produto,
            loja.nome AS nome_loja,
            estoque. * FROM Produto
INNER JOIN estoque ON estoque.id_produto = Produto.id
INNER JOIN loja ON estoque.id_loja = loja.id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Página Principal</title>
</head>

<body>

    <div class="container">
        <h1>Página Principal</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Loja</th>
                    <th scope="col">Qtd</th>
                    <th scope="col">Preço</th>
                    <th scope="col">C/ Desc</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>

                        <td><?php echo $linha['nome_produto'] ?></td>
                        <td><?php echo $linha['categoria'] ?></td>
                        <td><?php echo $linha['nome_loja'] ?></td>
                        <td>
                            <form action="adicionar_carrinho.php" method="POST">
                                <input type="number" name='quantidade'>                     
                            </form>
                        <td><?php echo $linha['preco'] ?></td>
                        <td><?php echo $linha['comDesc'] ?></td>
                        <td><?php echo $linha['subtotal'] ?></td>

                        <td>
                        <td>
                            <form action="adicionar_carrinho.php" method="POST">
                                <button class="btn btn-primary" name="btnAdd"
                                    value="<?php echo $linha['id']; ?>">Adicionar ao Carrinho</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form action="finalizar_carrinho.php" method="POST">
            <button class="btn btn-primary" name="btnEditar"
                value="<?php echo $linha['id']; ?>">Finalizar compra</button>
        </form>

    </div>
</body>

</html>