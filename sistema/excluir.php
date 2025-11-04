<?php
    include 'conexao.php';
    $id = $_POST['btnExcluir'];

    // APAGAR produto-caracteristica SE EXISTIR
    $sql = $pdo->prepare("DELETE FROM produto_caracteristica WHERE id_produto = ?");
    $sql->execute([$id]);

    // APAGAR estoque se Existir
    $sql = $pdo->prepare("DELETE FROM Estoque WHERE id_produto = ?");
    $sql ->execute([$id]);


    // APAGAR O PRODUTO
    $sql = $pdo->prepare("DELETE FROM produto WHERE id = ?");
    $sql->execute([$id]);

    header("Location: produtos.php");
    exit;
?>