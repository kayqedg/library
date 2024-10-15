<?php

session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    include_once('config.php');
    if ($_GET['id'] != 1) {
        $id = $_GET['id'];

        $sql = "DELETE FROM clientes WHERE id_cliente = '$id'";
        $result = $conexao->query($sql);
        header("location: system.php");

    } else {
        header("location: system.php");
    }
} else {
    header('location: ../index.php');
}

?>