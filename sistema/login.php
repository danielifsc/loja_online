

<?php
require_once("conexao.php");
?>

<?php
if ($cliente && password_verify($senha_digitada, $cliente['senha_hash'])) { 
    // Login bem-sucedido → inicia sessão 
    session_start(); 
    $_SESSION['cliente_id'] = $cliente['id']; 
    $_SESSION['cliente_nome'] = $cliente['nome']; 
    header("Location: index.php"); 
    exit(); 
} else { 
    $erro = "E-mail ou senha inválidos."; 
} 

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
        <form action="login.php" method="POST">
            <label for="email">Email: </label> <br>
            <input type="email" name="email" required><br>
            <label for="senha">Senha: </label> <br>
            <input type="password" name="senha" required ><br>
    
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>

<?php

