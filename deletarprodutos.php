<?php
    session_start();
    include_once('config.php');

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
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

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        try {
            $sql = "DELETE FROM produtos WHERE id=$id";
            if ($conexao->query($sql) === TRUE) {
                header('Location: produtos.php?delete_success=true');
                exit();
            } else {
                throw new Exception($conexao->error);
            }
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
                echo "<script>
                        alert('Produto associado em um plano existente, não é possível deletar');
                        window.location.href = 'produtos.php';
                      </script>";
                exit();
            } else {
                echo "Erro ao deletar: " . $e->getMessage();
            }
        }
    }

    $conexao->close();
?>
