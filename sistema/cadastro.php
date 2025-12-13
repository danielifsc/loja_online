// Exemplo: gerar hash de senha em PHP
<?php
require_once("conexao.php");
?>

<?php
$senha_plana = isset($_POST['senha']) ? $_POST['senha']  : '';
$email = isset($_POST['email']) ? $_POST['email']  : '';
$hash = password_hash($senha_plana, PASSWORD_DEFAULT);
//echo $hash; // Use esse valor no INSERT 
$sql = $pdo->prepare("INSERT INTO cliente (email, senha_hash)
    VALUES (?, ?)");

$sql->execute([$email, $hash]);

header("Location: login.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title></title>
</head>

<body>
    <div class="">
        <form action="cadastro.php" method="POST">
            <label for="email">Email: </label> <br>
            <input type="email" name="email" required><br>
            <label for="senha">Senha: </label> <br>
            <input type="password" name="senha" required><br>

            <input type="submit" value="Enviar">
        </form>
    </div>
</body>

</html>