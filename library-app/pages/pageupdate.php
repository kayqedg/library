<?php

session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password']) && isset($_GET)) {
    header('location:' . $_GET['local']);
} else {
    header('location: ../index.php');
}

?>