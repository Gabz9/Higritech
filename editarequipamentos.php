<?php
include_once('config.php');

if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nomeProduto'];
    $pressao = $_POST['unidadeMedida'];
    $raio = $_POST['producaoMinima'];
    $vazao = $_POST['producaoMaxima'];

    $sql = "UPDATE equipamentos SET nome='$nome', pressao='$pressao', raio=$raio, vazao=$vazao WHERE id=$id";
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
   
    <title>Editar Equipamento</title>

</head>

<body>

    <div class="container">
        <div class="caixaSuperior">
            <h2>Editar Equipamento</h2>
            <form action="editarequipamentos.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="campo-entrada">
                    <label for="nomeProduto">Nome do equipamento:</label>
                    <input type="text" id="nomeProduto" name="nomeProduto" value="<?php echo $row['nome']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="unidadeMedida">Pressão utilizada:</label>
                    <input type="text" id="unidadeMedida" name="unidadeMedida" value="<?php echo $row['pressao']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="producaoMinima">Raio de alcance:</label>
                    <input type="number" id="producaoMinima" name="producaoMinima" value="<?php echo $row['raio']; ?>" required>
                </div>
                <div class="campo-entrada">
                    <label for="producaoMaxima">Vazão Litros/Hora:</label>
                    <input type="number" id="producaoMaxima" name="producaoMaxima" value="<?php echo $row['vazao']; ?>" required>
                </div>
                <button class="cadastro" type="submit" name="editar">Salvar</button>
            </form>
        </div>
    </div>

</body>

</html>
