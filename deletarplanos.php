<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM planos WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$id]);

    header("Location: plano.php");
    exit();
}
?>