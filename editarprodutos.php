<?php
include_once('config.php');

if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nomeProduto'];
    $unidade_medida = $_POST['unidadeMedida'];
    $producao_minima = $_POST['producaoMinima'];
    $producao_maxima = $_POST['producaoMaxima'];

    $sql = "UPDATE produtos SET nome='$nome', unidade_medida='$unidade_medida', producao_minima='$producao_minima', producao_maxima='$producao_maxima' WHERE id='$id'";

    if ($conexao->query($sql) === TRUE) {
        header('Location: produtos.php');
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id='$id'";
    $result = $conexao->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Higritech_style/produtos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="Higritech_script/produtos.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Editar Produto</title>
</head>

<body>
    <div class="container">
        <div class="caixaSuperior">
            <h2>Editar Produto</h2>
            <form action="editarprodutos.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="campo-entrada">
                    <label for="nomeProduto">Nome do Produto:</label>
                    <input type="text" id="nomeProduto" name="nomeProduto" value="<?php echo $row['nome']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="unidadeMedida">Unidade de Medida:</label>
                    <input type="text" id="unidadeMedida" name="unidadeMedida" value="<?php echo $row['unidade_medida']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="producaoMinima">Produção Mínima:</label>
                    <input type="number" id="producaoMinima" name="producaoMinima" value="<?php echo $row['producao_minima']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="producaoMaxima">Produção Máxima:</label>
                    <input type="number" id="producaoMaxima" name="producaoMaxima" value="<?php echo $row['producao_maxima']; ?>" required>
                </div>
                <button class="cadastro" type="submit" name="atualizar">Atualizar</button>
            </form>
        </div>
    </div>
</body>

</html>