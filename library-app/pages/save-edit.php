<?php

session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    include_once('config.php');
    $user_id = $_POST['user-id'];
    $nome = $_POST['name'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $nivel = $_POST['level'];

    echo $user_id . ' ' . $nome . ' ' . $cpf . ' ' . $email . ' ' . $senha . ' ' . $nivel;

    $sql = "UPDATE clientes SET nome = '$nome', cpf = '$cpf', email = '$email', senha = '$senha', nivel = '$nivel' WHERE id_cliente = '$user_id'";

    $result = $conexao->query($sql);
    header('location: system.php');

} else {
    header('location: ../index.php');
}
?>