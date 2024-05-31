<?php
include_once('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM equipamentos WHERE id=$id";
    $conexao->query($sql);

    header('Location: equipamentos.php');
}

$conexao->close();
?>