<?php 
include 'conexao.php';
$id = $_POST['btnEditar'];
$sql = $pdo->prepare("SELECT * FROM produto WHERE id = ?");
$sql->execute([$id]);
$linha = $sql->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Editar produto</title>
</head>
<body>
    <h1>Editar o produto: <?php echo $linha['nome']?></h1>

    <div class="container">
        <form action="atualizar.php" method="POST" class="control-form">
            <input type="hidden" name="id"
            value="<?php echo $linha['id']?>">

            <input type="text" name="nome" 
            value="<?php echo $linha['nome']?>">

            <input type="text" name="descricao"
            value="<?php echo $linha['descricao']?>">

            <input type="date" name="data"
            value="<?php echo $linha['data_lancamento']?>">

            <input type="number" name="preco"
            value="<?php echo $linha['preco']?>">

            <select name="tipo" id="tipo" >
                <option value="<?php echo $linha['tipo1']?>">Usado</option>
                
                <option value="<?php echo $linha['tipo2']?>">Novo</option>
                
                <option value="<?php echo $linha['tipo3']?>">Promoção</option>
                
                <option value="<?php echo $linha['tipo4']?>">Liquidação</option>
            </select>

            <select name="categoria" id="categoria"  multiple>
                <option value="<?php echo $linha['categoria1']?>">Eletronico</option>

                <option value="<?php echo $linha['categoria2']?>">Informatica</option>

                <option value="<?php echo $linha['categoria3']?>">Telefonia</option>

                <option value="<?php echo $linha['categoria4']?>">Eletrodomesticos</option>
            </select>

            <input type="number" name="desconto_usados"
            value="<?php echo $linha['desconto_usados']?>">

            <input type="submit" name="btnSalvar" value="Salvar"
            class="btn btn-primary">
        </form>
    </div>

</body>
</html>