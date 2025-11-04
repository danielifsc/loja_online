<?php
    include 'conexao.php';
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $tipo = $_POST ['tipo'];
    $categoria = $_POST['categoria'];
    $dataL = $_POST ['data'];
    $desconto = $_POST['desconto_usados'];

    $sql = $pdo->prepare("UPDATE produto SET nome = ?, descricao = ?, preco = ?, tipo = ?, categoria = ?,
    data_lancamento = ?, desconto_usados = ? WHERE id = ?");
    $sql->execute([$nome, $descricao, $preco, $tipo, $categoria, $dataL, $desconto, $id]);

    header("Location: index.php");
    exit;