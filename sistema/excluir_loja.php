<?php
    include 'conexao.php';
    $id = $_POST['btnExcluir'];

    // APAGAR estoque SE EXISTIR
    $sql = $pdo->prepare("DELETE FROM estoque WHERE id_loja = ?");
    $sql->execute([$id]);

    // APAGAR O Produto
    $sql = $pdo->prepare("DELETE FROM loja WHERE id = ?");
    $sql->execute([$id]);

    header("Location: lojas.php");
    exit;
?>