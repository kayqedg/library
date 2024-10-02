<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = 'root';
$dbName = 'library_app';

$conexao = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conexao->connect_errno) {
    echo 'Erro';
} else {
    echo 'Conexão efetuada';
    echo '<br>';
}
?>