<?php
//id_sessao, id_produto, quantidade

include 'conexao.php';

$id = $_POST['btnAdd'];
$id_sessao = $_COOKIE['PHPSESSID'];
$quantidade = $_POST['quantidade'];

$sql_cria_tabela = "
    CREATE TEMPORARY TABLE IF NOT EXISTS CarrinhoTemporario (
        Id_sessao VARCHAR(255) NOT NULL,
        Id_produto INT NOT NULL,       
        quantidade DECIMAL(6,2) NOT NULL,

        PRIMARY KEY (Id_sessao, Id_produto),

        FOREIGN KEY (Id_produto) REFERENCES produto(id)
        
    ) 
";


    // APAGAR produto-caracteristica SE EXISTIR
    $sql = $pdo->prepare("INSERT INTO CarrinhoTemporario (id_sessao, id_produto, 
    quantidade)
    VALUES (?, ?, ?) WHERE id = ?");
    $sql->execute([$id_sessao, $id, $quantidade, $id]);


    header("Location: carrinhoCompras.php");
    exit;
