<?php
include_once('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_plano = "SELECT * FROM planos WHERE id = $id";
    $result_plano = $conexao->query($sql_plano);

    if ($result_plano->num_rows > 0) {
        $plano = $result_plano->fetch_assoc();
    } else {
        echo "Plano não encontrado.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $dataInicio = $_POST['dataInicio'];
    $dataFinal = $_POST['dataFinal'];
    $produto = $_POST['produto'];
    $equipamento = $_POST['equipamento'];
    $valorAgua = $_POST['valorAgua'];

    $sql_update = "UPDATE planos 
                   SET dataInicio = '$dataInicio', dataFinal = '$dataFinal', produto_id = '$produto', equipamento_id = '$equipamento', valorAgua = '$valorAgua' 
                   WHERE id = $id";

    if ($conexao->query($sql_update) === TRUE) {
        header("Location: plano.php");
        exit;
    } else {
        echo "Erro: " . $sql_update . "<br>" . $conexao->error;
    }
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
    <title>Editar Plano</title>
</head>

<body>
    <div class="container">
        <div class="caixaSuperior">
            <h2>Editar Plano de Irrigação</h2>
            <form method="POST" action="editarplanos.php">
                <input type="hidden" name="id" value="<?php echo $plano['id']; ?>">
                <div class="campo-entrada">
                    <label for="dataInicio">Data Início:</label>
                    <input type="date" id="dataInicio" name="dataInicio" value="<?php echo $plano['dataInicio']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="dataFinal">Data Final:</label>
                    <input type="date" id="dataFinal" name="dataFinal" value="<?php echo $plano['dataFinal']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="produto">Produto:</label>
                    <select id="produto" name="produto" required>
                        <?php
                        $sql_produtos = "SELECT id, nome FROM produtos";
                        $result_produtos = $conexao->query($sql_produtos);

                        if ($result_produtos->num_rows > 0) {
                            while ($row = $result_produtos->fetch_assoc()) {
                                $selected = $row['id'] == $plano['produto_id'] ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['nome'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="campo-entrada">
                    <label for="equipamento">Equipamento:</label>
                    <select id="equipamento" name="equipamento" required>
                        <?php
                        $sql_equipamentos = "SELECT id, nome FROM equipamentos";
                        $result_equipamentos = $conexao->query($sql_equipamentos);

                        if ($result_equipamentos->num_rows > 0) {
                            while ($row = $result_equipamentos->fetch_assoc()) {
                                $selected = $row['id'] == $plano['equipamento_id'] ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['nome'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="campo-entrada">
                    <label for="valorAgua">Valor Água/M³:</label>
                    <input type="number" id="valorAgua" name="valorAgua" value="<?php echo $plano['valorAgua']; ?>" required>
                </div>
                <button class="cadastro" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</body>

</html>