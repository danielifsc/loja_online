<?php

include 'conexao.php';

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$tipo = $_POST['tipo'];
$categoria = $_POST['categoria'];
$data_lancamento = $_POST['data'];
$desconto_usado = $_POST['desconto_usados'];


$sql = $pdo->prepare("INSERT INTO produto (nome, descricao, preco, tipo, categoria, data_lancamento, desconto_usados)
VALUES (?, ?, ?, ?, ?, ?, ?)");

$sql->execute([$nome, $descricao, $preco, $tipo, $categoria, $data_lancamento, $desconto_usado]);


header("Location: produtos.php");
exit;