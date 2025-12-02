<?php
    include 'conexao.php';
    $id = $_POST['id'];
    $nome = $_POST['nomeCarac'];
    $descricao = $_POST['descrCarac'];


    $sql = $pdo->prepare("UPDATE caracteristica SET nome = ?, descricao = ? 
    WHERE id = ?");
    $sql->execute([$nome, $descricao,  $id]);

    header("Location: caracteristicas.php");
    exit;
?>