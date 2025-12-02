<?php
    include 'conexao.php';
    $id = $_POST['id'];
    $nome = $_POST['nomeLoja'];
    $telefone = $_POST['telLoja'];
    $rua = $_POST['ruaLoja'];
    $numero = $_POST['numLoja'];
    $bairro = $_POST['bairroLoja'];
    $cep = $_POST['cepLoja'];
    $complemento= $_POST['complLoja'];
    $cidade = $_POST['cidadeLoja'];

    $sql = $pdo->prepare("UPDATE loja SET nome = ?, telefone = ?, 
    rua = ?, numero = ?, bairro = ?, cep = ?, complemento = ?, cidade = ? WHERE id = ?");
    $sql->execute([$nome, $telefone, $rua, $numero, $bairro, $cep, $complemento, $cidade,  $id]);

    header("Location: lojas.php");
    exit;
?>