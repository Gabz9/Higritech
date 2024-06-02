
<?php
    session_start();
    include_once('config.php');
    
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
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


    <div class="Conteudo" id="Conteudo">
        <div class="container">
            <div class="caixaSuperior">
                <h2>Cadastrar Produtos</h2>
                <form action="produtos.php" method="POST">
                    <div class="campo-entrada">
                        <label for="nomeProduto">Nome do Produto:</label>
                        <input type="text" id="nomeProduto" name="nomeProduto" required>
                    </div>
                    <div class="campo-entrada">
                        <label for="unidadeMedida">Unidade de Medida:</label>
                        <input type="text" id="unidadeMedida" name="unidadeMedida" required>
                    </div>
                    <div class="campo-entrada">
                        <label for="producaoMinima">Produção Mínima:</label>
                        <input type="number" id="producaoMinima" name="producaoMinima" required>
                    </div>
                    <div class="campo-entrada">
                        <label for="producaoMaxima">Produção Máxima:</label>
                        <input type="number" id="producaoMaxima" name="producaoMaxima" required>
                    </div>
                    <button class="cadastro" type="submit" name="cadastrar">Cadastrar</button>
                </form>

            </div>
            <div class="caixaInferior">
                <h2>Produtos cadastrados</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Unidade de Medida</th>
                            <th>Produção Mínima</th>
                            <th>Produção Máxima</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once ('config.php');

                        if (isset($_POST['cadastrar'])) {
                            $nome = $_POST['nomeProduto'];
                            $unidade_medida = $_POST['unidadeMedida'];
                            $producao_minima = $_POST['producaoMinima'];
                            $producao_maxima = $_POST['producaoMaxima'];

                            $sql = "INSERT INTO produtos (nome, unidade_medida, producao_minima, producao_maxima) 
                                    VALUES ('$nome', '$unidade_medida', '$producao_minima', '$producao_maxima')";
                            if ($conexao->query($sql) === TRUE) {
                                echo "Novo produto cadastrado  com sucesso";
                            } else {
                                echo "Erro: " . $sql . "<br>" . $conexao->error;
                            }
                        }

                        if (isset($_GET['delete'])) {
                            $id = $_GET['delete'];
                            try {
                                $sql = "DELETE FROM produtos WHERE id=$id";
                                if ($conexao->query($sql) === TRUE) {
                                    echo "Produto deletado com sucesso!";
                                } else {
                                    throw new Exception($conexao->error);
                                }
                            } catch (Exception $e) {
                                if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
                                    echo "<script>alert('Produto associado em um plano existente, não é possivel deletar');</script>";
                                } else {
                                    echo "Erro ao deletar: " . $e->getMessage();
                                }
                            }
                        }

                        $sql = "SELECT * FROM produtos";
                        $result = $conexao->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['nome']}</td>
                                    <td>{$row['unidade_medida']}</td>
                                    <td>{$row['producao_minima']}</td>
                                    <td>{$row['producao_maxima']}</td>
                                    <td>
                                        <a href='editarprodutos.php?id={$row['id']}'><i class='fa-solid fa-edit'></i></a>
                                        <a href='produtos.php?delete={$row['id']}'><i class='fa-solid fa-trash'></i></a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum produto cadastrado</td></tr>";
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