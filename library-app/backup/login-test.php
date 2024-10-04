<?php
session_start();

if (isset($_POST['submit'])) {
    include_once('config.php');
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sqlSelect = "SELECT * FROM clientes where nome = '$name' AND senha = '$password' ";
    $result = $conexao->query($sqlSelect);

    if ($result->num_rows < 1) {
        unset($_SESSION['name']);
        unset($_SESSION['password']);
        header('location: ../index.php');
    } else {
        $_SESSION['name'] = $name;
        $_SESSION['password'] = $password;
        header('location: system.php');
    }
} else {
    header('location: ../index.php');
}
?>