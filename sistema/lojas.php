<?php 
    include 'conexao.php';
    $sql = $pdo->query("SELECT * FROM loja");
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
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Rua</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Cep</th>
                    <th scope="col">Complemento</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                while($linha = $sql->fetch(PDO::FETCH_ASSOC)){
            ?>
                <tr>
                    <th scope="row"><?php echo $linha['id']?></th>
                    <td><?php echo $linha['nome']?></td>
                    <td><?php echo $linha['telefone'] ?></td>
                    <td><?php echo $linha['rua'] ?></td>
                    <td><?php echo $linha['numero'] ?></td>
                    <td><?php echo $linha['bairro'] ?></td>
                    <td><?php echo $linha['cep'] ?></td>
                    <td><?php echo $linha['complemento'] ?></td>
                    <td><?php echo $linha['cidade'] ?></td>
                    <td><form action="editar_loja.php" method="POST"> 
                        <button class="btn btn-primary" name="btnEditar" 
                        value="<?php echo $linha['id'];?>">Editar</button>
                    </form></td>
                    <td><form action="excluir_loja.php" method="POST"> 
                        <button class="btn btn-danger" name="btnExcluir" 
                        value="<?php echo $linha['id'];?>">Excluir</button>
                    </form></td>
              
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
        <form action="adicionar_loja.php" method="POST">
            <input type="text" name="nomeLoja" 
            placeholder="Digite o nome da loja.." required>

            <input type="tel" name="telLoja" 
            placeholder="Digite o telefone da loja.." required>
            
            <input type="text" name="ruaLoja" 
            placeholder="Digite a rua da loja.."  required>

            <input type="text" name="numLoja" 
            placeholder="Digite o numero da loja.."  required>

            <input type="text" name="bairroLoja" 
            placeholder="Digite o bairro da loja.."  required>

            <input type="text" name="cepLoja" 
            placeholder="Digite o cep da loja.."  required>

            <input type="text" name="complLoja" 
            placeholder="Digite o complemento da loja.."  required>

            <input type="text" name="cidadeLoja" 
            placeholder="Digite a cidade da loja.."  required>

            <input type="submit" value="Salvar" name="btnSalvar" class="btn btn-success">
        </form>
    </div>
</body>

</html>