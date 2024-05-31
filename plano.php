<?php
include_once('config.php');

$sql_produtos = "SELECT id, nome FROM produtos";
$result_produtos = $conexao->query($sql_produtos);

$sql_equipamentos = "SELECT id, nome, vazao FROM equipamentos";
$result_equipamentos = $conexao->query($sql_equipamentos);

$produtos_disponiveis = $result_produtos->num_rows > 0;
$equipamentos_disponiveis = $result_equipamentos->num_rows > 0;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Higritech_style/plano.css">
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
    <!-- Menu Superior -->
    <header>
        <div id="MenuSuperior">
            <div class="MenuSupItem">
                <button id="open_btn"><i class="fa-solid fa-list"></i></button>
                <h1>Higritech</h1>
            </div>
            <div id="MenuSup_btn">
                <a href="perfil.php"> <i class="fa-regular fa-user"></i> </a>
                <a href="login.php"> <i class="fa-solid fa-right-to-bracket"></i> </a>
            </div>
        </div>
    </header>
    <!-- Menu Lateral -->
    <div class="Conteudo">
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
                <h2>Cadastrar Plano de Irrigação</h2>
                <form method="POST" action="plano.php">
                    <div class="campo-entrada">
                        <label for="dataInicio">Data Início:</label>
                        <input type="date" id="dataInicio" name="dataInicio" required>
                    </div>
                    <div class="campo-entrada">
                        <label for="dataFinal">Data Final:</label>
                        <input type="date" id="dataFinal" name="dataFinal" required>
                    </div>
                    <div class="campo-entrada">
                        <label for="produto">Produto:</label>
                        <select id="produto" name="produto" required>
                            <option value="" selected disabled>Selecione um produto</option>
                            <?php
                            if ($produtos_disponiveis) {
                                while ($row = $result_produtos->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="campo-entrada">
                        <label for="equipamento">Equipamento:</label>
                        <select id="equipamento" name="equipamento" required>
                            <option value="" selected disabled>Selecione um equipamento</option>
                            <?php
                            if ($equipamentos_disponiveis) {
                                while ($row = $result_equipamentos->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="campo-entrada">
                        <label for="valorAgua">Valor Água/M³:</label>
                        <input type="number" id="valorAgua" name="valorAgua" required>
                    </div>
                    <?php if (!$produtos_disponiveis): ?>
                        <div class="campo-entrada">
                            <span style="color:red;">É necessário cadastrar pelo menos um produto antes de criar um plano de irrigação.</span>
                        </div>
                    <?php endif; ?>
                    <?php if (!$equipamentos_disponiveis): ?>
                        <div class="campo-entrada">
                            <span style="color:red;">É necessário cadastrar pelo menos um equipamento antes de criar um plano de irrigação.</span>
                        </div>
                    <?php endif; ?>
                    <button class="cadastro" type="submit" <?php if (!$produtos_disponiveis || !$equipamentos_disponiveis) echo 'disabled'; ?>>Cadastrar</button>
                </form>
            </div>
            <div class="caixaInferior">
                <h2>Planos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Data Inicial</th>
                            <th>Data Final</th>
                            <th>Produto</th>
                            <th>Equipamento</th>
                            <th>Custo total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $produtos_disponiveis && $equipamentos_disponiveis) {
                            $dataInicio = $_POST['dataInicio'];
                            $dataFinal = $_POST['dataFinal'];
                            $produto = $_POST['produto'];
                            $equipamento = $_POST['equipamento'];
                            $valorAgua = $_POST['valorAgua'];

                            // Buscar a vazão do equipamento selecionado
                            $sql_vazao = "SELECT vazao FROM equipamentos WHERE id = $equipamento";
                            $result_vazao = $conexao->query($sql_vazao);

                            if ($result_vazao->num_rows > 0) {
                                $row = $result_vazao->fetch_assoc();
                                $vazao = $row['vazao'];
                                $custoTotal = $vazao * $valorAgua;

                                $sql_insert = "INSERT INTO planos (dataInicio, dataFinal, produto_id, equipamento_id, valorAgua, custoTotal) 
                                                VALUES ('$dataInicio', '$dataFinal', '$produto', '$equipamento', '$valorAgua', '$custoTotal')";

                                if ($conexao->query($sql_insert) === TRUE) {
                                    echo "Novo plano cadastrado com sucesso";
                                } else {
                                    echo "Erro: " . $sql_insert . "<br>" . $conexao->error;
                                }
                            } else {
                                echo "Erro ao buscar a vazão do equipamento.";
                            }
                        }

                        $sql_planos = "SELECT planos.id, planos.dataInicio, planos.dataFinal, produtos.nome AS produto, equipamentos.nome AS equipamento, planos.custoTotal 
                                        FROM planos 
                                        JOIN produtos ON planos.produto_id = produtos.id 
                                        JOIN equipamentos ON planos.equipamento_id = equipamentos.id";
                        $result_planos = $conexao->query($sql_planos);

                        if ($result_planos->num_rows > 0) {
                            while ($row = $result_planos->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row['id'] . "</td>
                                        <td>" . $row['dataInicio'] . "</td>
                                        <td>" . $row['dataFinal'] . "</td>
                                        <td>" . $row['produto'] . "</td>
                                        <td>" . $row['equipamento'] . "</td>
                                        <td>" . $row['custoTotal'] . "</td>
                                        <td>
                                            <a href='editarplanos.php?id={$row['id']}'><i class='fa-solid fa-edit'></i></a>
                                            <a href='plano.php?delete={$row['id']}'><i class='fa-solid fa-trash'></i></a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Nenhum plano cadastrado</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
