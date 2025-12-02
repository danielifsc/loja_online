<?php
    include 'conexao.php';
    $id = $_POST['btnExcluir'];

    // APAGAR estoque SE EXISTIR
    $sql = $pdo->prepare("DELETE FROM produto_caracteristica WHERE id_caracteristica = ?");
    $sql->execute([$id]);

    // APAGAR O Produto
    $sql = $pdo->prepare("DELETE FROM caracteristica WHERE id = ?");
    $sql->execute([$id]);

    header("Location: caracteristicas.php");
    exit;
?>