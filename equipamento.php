<?php
session_start();
include_once('config.php');

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    exit();
}
$logadoEmail = $_SESSION['email'];

// Conectando ao banco de dados
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Buscando o nome do usuário
$sqlNome = "SELECT nome FROM usuarios WHERE email = '$logadoEmail'";
$resultNome = $conexao->query($sqlNome);
$logadoNome = '';
if ($resultNome->num_rows > 0) {
    $rowNome = $resultNome->fetch_assoc();
    $logadoNome = $rowNome['nome'];
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
    <title>Higritech</title>
</head>

<body>

    <!--            Menu Superior            -->

    <header>
        <div id="MenuSuperior">
            <div class="MenuSupItem">
                <button id="open_btn"><i class="fa-solid fa-list"></i></button>
                <h1>Higritech</h1>
            </div>
            <?php
            echo '<h4 class="bvUsuario"> <u>' . $logadoNome . '</u></h4>';
            ?>
            <div id="MenuSup_btn">
                <a href="perfil.php"> <i class="fa-regular fa-user"></i> </a>
                <a href="sair.php"> <i class="fa-solid fa-right-to-bracket"></i> </a>
            </div>
        </div>
    </header>

    <!--                Menu Lateral           -->

    <div class="Conteudo" id="Conteudo">
        <nav class="MenuLateral" id="MenuLateral_fun">
            <ul>
                <li>
                    <i class="fa-solid fa-house"></i>
                    <a href="index.php"> Menu </a>
                </li>
                <li>
                    <i class="fa-solid fa-tag"></i>
                    <a href="produtos.php"> Produtos </a>
                </li>
                <li>
                    <i class="fa-solid fa-faucet-drip"></i>
                    <a href="#" class="SubMenuLateral" onclick="toggleSubMenu()"> Irrigação </a>
                </li>
                <ul id="SubMenuIrrigacao" style="display: none;">
                    <li>
                        <i class="fa-solid fa-wrench"></i>
                        <a href="equipamento.php"> Equipamentos </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-droplet"></i>
                        <a href="plano.php"> Planos </a>
                    </li>
                </ul>
            </ul>
        </nav>

        <div class="container">
            <div class="caixaSuperior">
                <h2>Cadastrar Equipamentos</h2>
                <form action="equipamento.php" method="POST">
                    <div class="campo-entrada">
                        <label for="nomeEquipamento">Nome do equipamento:</label>
                        <input type="text" id="nomeEquipamento" name="nomeEquipamento" required>
                    </div>
                    <div class="campo-entrada">
                        <label for="tempo">Utilização diária (horas): </label>
                        <input type="decimal" id="tempo" name="tempo" required>
                    </div>
                    <div class="campo-entrada">
                        <label for="raio">Raio de alcance (metros):</label>
                        <input type="number" id="raio" name="raio" required>
                    </div>
                    <div class="campo-entrada">
                        <label for="vazao">Vazão Litros/Hora:</label>
                        <input type="decimal" id="vazao" name="vazao" required>
                    </div>
                    <button class="cadastro" type="submit" name="cadastrar">Cadastrar</button>
                </form>

            </div>
            <div class="caixaInferior">
                <h2>Equipamentos cadastrados</h2>
                <?php
                if (isset($_GET['delete_success'])) {
                    echo "<p style='color: green;'>Equipamento deletado com sucesso!</p>";
                }
                if (isset($_GET['delete_error'])) {
                    echo "<p style='color: red;'>Equipamento associado em um plano existente, não é possível deletar.</p>";
                }
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Horas de Utilização</th>
                            <th>Raio</th>
                            <th>Vazão</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once('config.php');

                        if (isset($_POST['cadastrar'])) {
                            $nome = $_POST['nomeEquipamento'];
                            $tempo = $_POST['tempo'];
                            $raio = $_POST['raio'];
                            $vazao = $_POST['vazao'];

                            $sql = "INSERT INTO equipamentos (nome, tempo, raio, vazao) VALUES ('$nome', '$tempo', $raio, $vazao)";
                            if ($conexao->query($sql) === TRUE) {
                                echo "Novo equipamento cadastrado com sucesso!";
                            } else {
                                echo "Erro: " . $sql . "<br>" . $conexao->error;
                            }
                        }

                        $sql = "SELECT * FROM equipamentos";
                        $result = $conexao->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['nome']}</td>
                                    <td>{$row['tempo']}</td>
                                    <td>{$row['raio']}</td>
                                    <td>{$row['vazao']}</td>
                                    <td>
                                        <a href='editarequipamentos.php?id={$row['id']}'><i class='fa-solid fa-edit'></i></a>
                                        <a href='deletarequipamentos.php?delete={$row['id']}'><i class='fa-solid fa-trash'></i></a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum equipamento cadastrado</td></tr>";
                        }

                        $conexao->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
