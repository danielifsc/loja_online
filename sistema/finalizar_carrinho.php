<?php
include 'conexao.php';

$nome = $_POST['nome'];
$telefone = $_POST['tel'];
$email = $_POST['email'];
$data_cadastro = $_POST['data_cadastro'];
$senha_hash = $_POST['senha_hash'];

$id_cliente = $_POST['id_cliente'];
$id_loja = $_POST['id_loja'];
$valor_total = $_POST['valor_total'];
$quantidade_desejada = $_POST['quantidade_desejada'];

$sql = $pdo->prepare("INSERT INTO venda( id_cliente, 
    id_loja, data_venda, valor_total)
    VALUES (?, ?, ?, ?)");
$sql->execute([$id_cliente, $id_loja, $data_venda, $valor_total]);



$sql = $pdo->prepare("SELECT e.quantidade_disponivel >= $quantidade_desejada 
FROM Estoque e 
WHERE e.id_produto = ? AND e.id_loja = ?; 
INSERT INTO itemVenda (nome, email
     telefone, data_cadastro, senha_hash )
    VALUES (?, ?, ?, ?, ?)");
$sql->execute([$nome, $email, $telefone, $data_cadastro, $senha_hash]);

$sql = $pdo->prepare("UPDATE estoque SET quantidade_disponivel = quantidade_disponivel - ?
 WHERE estoque.id_loja = loja.id ");
$sql->execute([$quantidade_desejada]);

header("Location: carrinhoCompras.php");
exit;
