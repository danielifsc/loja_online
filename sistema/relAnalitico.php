<?php 
    include 'conexao.php';

    // 1. Média dos precos de todos os produtos
    $sql = $pdo->query("SELECT TRUNCATE(AVG(preco), 2) as media FROM Produto");
    $mediaPrecoProdutos = $sql->fetch(PDO::FETCH_ASSOC)['media'];

    // 2. Média dos precos de todos os produtos com descontos
    $sql2 = $pdo->query("SELECT TRUNCATE(AVG(preco), 2) as media FROM Produto WHERE desconto_usados > 0");
    $mediaPrecoProdutosDescontos = $sql2->fetch(PDO::FETCH_ASSOC)['media'];
    isset($mediaPrecoProdutosDescontos) ? $mediaPrecoProdutosDescontos = $mediaPrecoProdutosDescontos :  $mediaPrecoProdutosDescontos = 0; 

    // 3. Preço máximo entre todos os produtos da categoria "Eletronico"
    $sql3 = $pdo->query("SELECT TRUNCATE(MAX(preco), 2) as maximo FROM Produto WHERE categoria LIKE 'Eletronico'");
    $MaximoPrecoEletronico = $sql3->fetch(PDO::FETCH_ASSOC)['maximo'];

    // 4. Lista todos os produtos que foram lançados há mais de 6 meses a partir de hoje
    $sql4 = $pdo->query("SELECT * FROM produto WHERE data_lancamento < date_sub(curdate(), INTERVAL 6 month)");
   // $LancamentoMaisSeisMeses = $sql->fetch(PDO::FETCH_ASSOC)['*'];



    // 5. Encontre o produto mais caro e o mais barato e retorne seus nomes e preços
    $sql5 = $pdo->query("(SELECT nome, preco FROM Produto ORDER BY preco DESC LIMIT 1) 
     UNION ALL
     (SELECT nome, preco FROM Produto ORDER BY preco ASC LIMIT 1 )");
    //$MaisCaroAndBarato = $sql5->fetch(PDO::FETCH_ASSOC)['nome']['minimo']['maximo'];

    // 6. Conte quantos caracteres existem na descrição de cada produto e retorne o nome do produto e o número de caracateres
    $sql6 = $pdo->query("SELECT nome, LENGTH(descricao) as c FROM Produto");
    //$QuantosCaracteres = $sql6->fetch(PDO::FETCH_ASSOC)['media'];

    // 7. Lista o nome e a descrição de todas as características, mas retorne apenas os primeiros 30 caracteres da descrição
    $sql7 = $pdo->query("SELECT nome, SUBSTRING(descricao, 1, 30) as d FROM Produto ");
   // $mediaPrecoProdutos = $sql->fetch(PDO::FETCH_ASSOC)['media'];
    
   
    ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Produtos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        .icon-placeholder {
            font-size: 2.5rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h1 class="text-center mb-5">Relatório Analítico</h1>

    <div class="row g-4 mb-5">

        <div class="card">
            <div class="card-header">
                Média dos preços de todos os produtos
            </div>
            <div class="card-body">
                <h5 class="card-title">R$ <?= $mediaPrecoProdutos ?></h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Média dos preços de todos os produtos com descontos
            </div>
            <div class="card-body">
                <h5 class="card-title">R$ <?= $mediaPrecoProdutosDescontos ?></h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Preço Maximo de um produto da categoria eletrônico
            </div>
            <div class="card-body">
                <h5 class="card-title">R$ <?= $MaximoPrecoEletronico ?></h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Todos os produtos que foram lançados há mais de 6 meses
            </div>
            <div class="card-body">
           <?php     while($linha = $sql4->fetch(PDO::FETCH_ASSOC)){  ?>
                     <p><?php echo $linha['nome']?> </p>
            <?php } ?>
                
            </div>
        </div>

        
        <div class="card">
            <div class="card-header">
                Produto mais caro e o mais barato
            </div>
            <div class="card-body">
           <?php     while($linha = $sql5->fetch(PDO::FETCH_ASSOC)){  ?>
                     <p><?php echo $linha['nome'].': '. $linha['preco']?> </p>
            <?php } ?>
                
            </div>
        </div>    

        <div class="card">
            <div class="card-header">
                Caracteres por Descrição
            </div>
            <div class="card-body">
           <?php     while($linha = $sql6->fetch(PDO::FETCH_ASSOC)){  ?>
                     <p><?php echo $linha['nome'].': '. $linha['c']?> </p>
            <?php } ?>
                
            </div>
        </div>   
        
        <div class="card">
            <div class="card-header">
                Descrição Reduzida
            </div>
            <div class="card-body">
           <?php     while($linha = $sql7->fetch(PDO::FETCH_ASSOC)){  ?>
                     <p><?php echo $linha['nome'].': '. $linha['d']?> </p>
            <?php } ?>
                
            </div>
        </div>   

    </div>
</div>

<!-- Bootstrap JS  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>