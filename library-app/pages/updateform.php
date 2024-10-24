<?php

session_start();



if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    header('location: stock.php');
} else {
    header('location: ../index.php');
}
// echo $password;
// echo '<br>';
// echo $name;
?>