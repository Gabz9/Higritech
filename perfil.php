<?php
session_start();
include_once('config.php');

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}

$logado = $_SESSION['email'];

// Conectando ao banco de dados
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Obter informações do usuário
$sql_usuario = "SELECT * FROM usuarios WHERE email = '$logado'";
$result_usuario = $conexao->query($sql_usuario);
$usuario = $result_usuario->fetch_assoc();

$atualizacao_sucesso = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $novo_nome = $_POST['nome'];

    $erros = [];

    // Verificar senha atual
    if ($usuario['senha'] != $senha_atual) {
        $erros[] = "Senha atual incorreta.";
    }

    // Atualizar senha
    if (!empty($nova_senha)) {
        $sql_update_senha = "UPDATE usuarios SET senha = '$nova_senha' WHERE email = '$logado'";
        if (!$conexao->query($sql_update_senha)) {
            $erros[] = "Erro ao atualizar a senha.";
        }
    }
    // Atualizar nome
    if (!empty($novo_nome)) {
        $sql_update_nome = "UPDATE usuarios SET nome = '$novo_nome' WHERE email = '$logado'";
        if (!$conexao->query($sql_update_nome)) {
            $erros[] = "Erro ao atualizar o nome.";
        }
    }

    if (empty($erros)) {
        $atualizacao_sucesso = true;
    } else {
        foreach ($erros as $erro) {
            echo "<p>$erro</p>";
        }
    }
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Higritech_style/perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&family=Teko:wght@300..700&display=swap"
        rel="stylesheet">
    <title>Higritech - Perfil</title>
</head>

<body>
    <a href="index.php" class="back-btn">Voltar</a>
    <div class="container">
        <div class="wrapper">
            <form method="POST" action="">
                <h1>Editar perfil:</h1>
                <h1 class="nomePerfil"><?php echo htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8'); ?></h1>

                <div class="input-box">
                    <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="senha_atual" placeholder="Senha atual" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="nova_senha" placeholder="Nova senha">
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <button type="submit" class="btn">Editar</button>
            </form>
        </div>
    </div>

    <?php if ($atualizacao_sucesso): ?>
    <script>
        alert("Dados atualizados com sucesso!");
        window.location.href = "index.php";
    </script>
    <?php endif; ?>
</body>

</html>