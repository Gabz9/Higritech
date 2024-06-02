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

    // Consultas para contar os produtos e equipamentos
    $sqlProdutos = "SELECT COUNT(*) AS total_produtos FROM produtos";
    $resultProdutos = $conexao->query($sqlProdutos);
    $totalProdutos = 0;
    if ($resultProdutos->num_rows > 0) {
        $rowProdutos = $resultProdutos->fetch_assoc();
        $totalProdutos = $rowProdutos['total_produtos'];
    }

    $sqlEquipamentos = "SELECT COUNT(*) AS total_equipamentos FROM equipamentos";
    $resultEquipamentos = $conexao->query($sqlEquipamentos);
    $totalEquipamentos = 0;
    if ($resultEquipamentos->num_rows > 0) {
        $rowEquipamentos = $resultEquipamentos->fetch_assoc();
        $totalEquipamentos = $rowEquipamentos['total_equipamentos'];
    }

    $sqlPlanos = "SELECT COUNT(*) AS total_planos FROM planos";
    $resultPlanos = $conexao->query($sqlPlanos);
    $totalPlanos = 0;
    if ($resultPlanos->num_rows > 0) {
        $rowPlanos = $resultPlanos->fetch_assoc();
        $totalPlanos = $rowPlanos['total_planos'];
    }

    $conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Higritech_style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Teko:wght@300..700&display=swap"
        rel="stylesheet">
    <script src="Higritech_script/index.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="icon" rel="Higritech_repo/OIG3.pWkhLaUsxrpuI.ico" type="image/x-icon">

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
                <?php
                    echo '<h4 class="bvUsuario"> Bem vindo <u>' . $logadoNome . '</u></h4>';
                ?>
            <div id="MenuSup_btn">
                <a href="perfil.php"> <i class="fa-regular fa-user"></i> </a>
                <a href="sair.php"> <i class="fa-solid fa-right-to-bracket"></i> </a>
            </div>
        </div>
    </header>

    <!-- Menu Lateral -->
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
        <div class="DashProduto">
            <i class="fa-solid fa-leaf"></i>
            <p> Produtos Cadastrados: <span class="Dashvalor"> <?php echo $totalProdutos; ?> </span> </p>
        </div>

        <div class="DashEquipamento">
            <i class="fa-solid fa-shower"></i>
            <p> Equipamentos Cadastrados: <span class="Dashvalor"> <?php echo $totalEquipamentos; ?> </span> </p>
        </div>

        <div class="DashPlano">
            <i class="fa-solid fa-droplet"></i>
            <p> Planos Cadastrados: <span class="Dashvalor"> <?php echo $totalPlanos; ?> </span> </p>
        </div>
    </div>
</body>

</html>
