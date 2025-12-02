<?php
include 'conexao.php';
$id = $_POST['btnEditar'];
$sql = $pdo->prepare("SELECT * FROM Produto WHERE id = ?");
$sql->execute([$id]);
$linha = $sql->fetch(PDO::FETCH_ASSOC);


$sql = $pdo->prepare("SELECT COLUMN_TYPE
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = ?
  AND TABLE_NAME = ?
  AND COLUMN_NAME = ?;");

$sql->execute([$banco, 'produto', 'tipo']);
$colunaTipo = $sql->fetchColumn();



// ----------------------------------------------------------------
// PASSO 1: Extrair a lista de valores do ENUM da string 'colunaTipo'
// ----------------------------------------------------------------
$tiposDisponiveis = [];

// Exemplo de $colunaTipo: "enum('Eletrônico','Roupa','Alimento')"
if (preg_match("/^enum\('(.*)'\)$/", $colunaTipo, $matches)) {
    // $matches[1] conterá apenas: 'Eletrônico','Roupa','Alimento'
    $optionsString = $matches[1] ?? '';
    // Converte a string em um array: ['Eletrônico', 'Roupa', 'Alimento']
    $tiposDisponiveis = explode("','", $optionsString);
}

$valoresPermitidos = [];

// Ajuste o regex para buscar "set" em vez de "enum"
// Exemplo de $colunaTipo: "set('Opção A','Opção B','Opção C')"
if (preg_match("/^set\('(.*)'\)$/", $colunaTipo, $matches)) {
    // A string $matches[1] conterá apenas: 'Opção A','Opção B','Opção C'
    $optionsString = $matches[1] ?? '';
    // Converte a string em um array: ['Opção A', 'Opção B', 'Opção C']
    $valoresPermitidos = explode("','", $optionsString);
}

// O valor ATUAL do produto (se for SET), é uma string separada por vírgulas.
// Precisamos transformá-lo em um array para checagem fácil.
// Ex: Se $linha['tipo'] for "Opção A,Opção C"
$valoresAtuais = explode(',', $linha['categoria']);
// ----------------------------------------------------------------
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Editar Aluno</title>
</head>

<body>
    <div class="container my-4">
        <h1>Editar o produto: <?php echo $linha['nome'] ?></h1>
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id"
                value="<?php echo $linha['id'] ?>" class="form-control">

            <input type="text" name="nome"
                value="<?php echo $linha['nome'] ?>" class="form-control">

            <input type="text" name="descricao"
                value="<?php echo $linha['descricao'] ?>" class="form-control">

            <input type="text" name="preco"
                value="<?php echo $linha['preco'] ?>" class="form-control">
            <select class="form-select form-select-lg mb-3" name="tipo" aria-label="Selecione um tipo">

                <option value="" disabled>Selecione um tipo...</option>

                <?php
                // Variável para facilitar a leitura
                $tipo_atual = $linha['tipo'];

                // PASSO 2 & 3: Iterar sobre os tipos disponíveis e gerar as opções
                foreach ($tiposDisponiveis as $tipo) {

                    // Verifica se o valor do loop ($tipo) é igual ao valor atual do produto ($tipo_atual)
                    $selected = ($tipo == $tipo_atual) ? 'selected' : '';
                ?>

                    <option value="<?php echo htmlspecialchars($tipo) ?>" <?php echo $selected ?>>
                        <?php echo htmlspecialchars($tipo) ?>
                    </option>

                <?php
                }
                ?>
            </select>

            <div class="mb-3">
                <label class="form-label">Selecione os Tipos:</label>
                <div class="d-flex flex-wrap gap-3">
                    <?php
                    // Itera sobre todos os valores possíveis extraídos
                    foreach ($valoresPermitidos as $valor) {

                        // Verifica se o valor atual ($valor) está presente no array de valores já salvos ($valoresAtuais)
                        // A função in_array() verifica se o item já existe.
                        $checked = in_array($valor, $valoresAtuais) ? 'checked' : '';
                    ?>

                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="categoria[]"
                                value="<?php echo htmlspecialchars($valor) ?>"
                                id="categoria_<?php echo htmlspecialchars($valor) ?>"
                                <?php echo $checked ?>>
                            <label class="form-check-label" for="categoria_<?php echo htmlspecialchars($valor) ?>">
                                <?php echo htmlspecialchars($valor) ?>
                            </label>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>

            <input type="date" name="data"
                value="<?php echo $linha['data_lancamento'] ?>" class="form-control">

            <input type="text" name="desconto"
                value="<?php echo $linha['desconto_usados'] ?>" class="form-control">

            <input type="submit" name="btnSalvar" value="Salvar"
                class="btn btn-primary">
        </form>
    </div>

</body>

</html>