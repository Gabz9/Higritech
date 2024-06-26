<?php
include_once('config.php');

if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nomeEquipamento'];
    $tempo = $_POST['tempo'];
    $raio = $_POST['raio'];
    $vazao = $_POST['vazao'];

    $sql = "UPDATE equipamentos SET nome='$nome', tempo='$tempo', raio=$raio, vazao=$vazao WHERE id=$id";
    if ($conexao->query($sql) === TRUE) {
        echo "Equipamento atualizado com sucesso!";
        header('Location: equipamento.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM equipamentos WHERE id=$id";
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
    <link rel="icon" href="Higritech_repo/OIG3.pWkhLaUsxrpuI.ico" type="image/x-icon">

    <title>Editar Equipamento</title>

</head>

<body>

    <div class="container">
        <div class="caixaSuperior">
            <h2>Editar Equipamento</h2>
            <form action="editarequipamentos.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="campo-entrada">
                    <label for="nomeEquipamento">Nome do equipamento:</label>
                    <input type="text" id="nomeEquipamento" name="nomeEquipamento" value="<?php echo $row['nome']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="tempo">Utilização diária (horas):</label>
                    <input type="text" id="tempo" name="tempo" value="<?php echo $row['tempo']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="raio">Raio de alcance (metros):</label>
                    <input type="number" id="raio" name="raio" value="<?php echo $row['raio']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="vazao">Vazão Litros/Hora:</label>
                    <input type="number" id="vazao" name="vazao" value="<?php echo $row['vazao']; ?>" required>
                </div>
                <button class="cadastro" type="submit" name="editar">Salvar</button>
            </form>
        </div>
    </div>

</body>

</html>
