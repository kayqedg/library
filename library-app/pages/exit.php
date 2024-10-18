<?php

session_start();
unset($_SESSION["name"]);
unset($_SESSION["password"]);
unset($_SESSION["id_user"]);
header("location: ../index.php");

?>