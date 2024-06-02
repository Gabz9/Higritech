<?php

include_once('config.php');

var_dump('entrou');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM produtos WHERE id='$id'";

    if ($conexao->query($sql) === TRUE) {
        header('Location: produtos.php');
    } else {
        echo "Erro ao deletar: " . $conexao->error;
    }
}
?>