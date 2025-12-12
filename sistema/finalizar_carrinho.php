<?php
include 'conexao.php';

$nome = $_POST['nomeLoja'];
$telefone = $_POST['telLoja'];
$email = $_POST['ruaLoja'];
$data_cadastro = $_POST['numLoja'];
$senha_hash = $_POST['bairroLoja'];

$cep = $_POST['cepLoja'];
$complemento = $_POST['complLoja'];
$cidade = $_POST['cidadeLoja'];

$sql = $pdo->prepare("INSERT INTO venda(data_venda, id_cliente, 
    id_loja, valor_total)
    VALUES (?, ?, ?, ?)");
$sql->execute([$id_cliente, $id_loja, $data_venda, $valor_total]);


$sql = $pdo->prepare("INSERT INTO itemVenda (nome, email
     telefone, data_cadastro, senha_hash )
    VALUES (?, ?, ?, ?, ?)");
$sql->execute([$nome, $email , $telefone, $data_cadastro, $senha_hash]);

$sql = $pdo->prepare("UPDATE estoque SET quantidade_disponivel = quantidade_disponivel - ?
 WHERE   ");
$sql->execute([$id]);

header("Location: lojas.php");
exit;
