<?php

session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    include_once('config.php');

    $name = $_SESSION["name"];
    $password = $_SESSION["password"];

    $sql = "SELECT id_cliente FROM clientes WHERE nome = '$name'";
    $result = $conexao->query($sql);
    $data = $result->fetch_assoc();
    $_SESSION['id_user'] = $data["id_cliente"];

    $id_user = $_SESSION["id_user"];

} else {
    header('location: ../index.php');
}
// echo $password;
// echo '<br>';
// echo $name;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Home</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
</head>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
</style>

<body>
    <main class='system-div'>
        <div class="system-nav">
            <a href="system.php"><img src="" alt="">Sistema</a>
            <a href=""><img src="" alt="">Dashboard</a>
            <a href="shop.php"><img src="" alt="">Comprar</a>
            <a href=""><img src="" alt="">Dashboard</a>
            <a href=""><img src="" alt="">Dashboard</a>
        </div>
        <div class="system-content">

            <h1 class="title">Library</h1>
            <h2 class="title">Seja bem vindo <?php echo $name ?></h2>
            <!-- <p><?php echo $id_user ?></p> -->
            <a href="exit.php" class="btn btn-danger">Sair</a>
        </div> <br>

    </main>
</body>

</html>