<?php 
    include 'conexao.php';

    $nome = $_POST['nomeLoja'];
    $telefone = $_POST['telLoja'];
    $rua = $_POST['ruaLoja'];
    $numero = $_POST['numLoja'];
    $bairro = $_POST['bairroLoja'];
    $cep = $_POST['cepLoja'];
    $complemento = $_POST['complLoja'];
    $cidade = $_POST['cidadeLoja'];

    $sql = $pdo->prepare("INSERT INTO loja (nome, telefone, 
    rua, numero, bairro, cep, complemento, cidade )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $sql->execute([$nome, $telefone, $rua, $numero, $bairro, $cep, $complemento, $cidade]);

    header("Location: lojas.php");
    exit;
?>