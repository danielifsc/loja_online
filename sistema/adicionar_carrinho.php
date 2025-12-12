<?php
//id_sessao, id_produto, quantidade

include 'conexao.php';

$id = $_POST['btnAdd'];
$id_sessao = $_COOKIE['PHPSESSID'];


$sql_cria_tabela = "
    CREATE TEMPORARY TABLE IF NOT EXISTS CarrinhoTemporario (
        Id_sessao VARCHAR(255) NOT NULL,
        Id_produto INT NOT NULL,       
        quantidade DECIMAL(6,2) NOT NULL,

        PRIMARY KEY (Id_sessao, Id_produto),

        FOREIGN KEY (Id_produto) REFERENCES produto(id)
        
    ) ENGINE=InnoDB; -- Adicionando o ENGINE para garantir a funcionalidade da FK
";

try {
    $pdo->exec($sql_cria_tabela);

    // A partir daqui, você pode usar a tabela normalmente:
    // Exemplo: Adicionar um item
    //$stmt = $pdo->prepare("INSERT INTO CarrinhoTemporario (Id_sessao, Id_produto, quantidade) VALUES (?, ?, ?)");
    //$stmt->execute(['sua_sessao_id', 15, 2.0]);



    // APAGAR produto-caracteristica SE EXISTIR
    $sql = $pdo->prepare("INSERT INTO CarrinhoTemporario (id_sessao, id_produtos, 
    quantidade)
    VALUES (?, ?, ?) WHERE id = ?");
    $sql->execute([$id_sessao, $id_produto, $quantidade, $id]);


    header("Location: carrinhoCompras.php");
    exit;
} catch (PDOException $e) {
    die("Erro ao criar a tabela temporária: " . $e->getMessage());
}
