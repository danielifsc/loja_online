<?php 
    include 'conexao.php';

    $nome = $_POST['nomeCarac'];
    $descricao = $_POST['descrCarac'];
 
 

    $sql = $pdo->prepare("INSERT INTO Caracteristica (nome, descricao)
    VALUES (?, ?)");

    $sql->execute([$nome, $descricao]);

    header("Location: caracteristicas.php");
    exit;
?>