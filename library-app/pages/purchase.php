<?php
include_once("config.php");
session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM livros WHERE id_livro = '$id'";
    $result = $conexao->query($sql);
    $data = $result->fetch_assoc();
} else {
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Document</title>
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
    body {
        background-color: rgb(250, 247, 240);
    }

    .div-purchase {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: 2px solid rgb(216, 210, 194);
        padding: 1rem;
        width: 50%;
        height: 60%;
    }

    .div-item {
        display: flex;
        flex-direction: row;
        gap: 1rem;
    }

    .item-photo {
        width: 200px;
        height: 250px;
        border: 2px solid rgb(216, 210, 194);
        padding: 0.5rem;
    }

    .item-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-name {
        color: black;
    }

    .item-author-year {
        margin-top: -10px;
        font-size: 20px;
    }

    .item-genre {
        font-size: 18px;
    }

    .btn-success {
        float: right;
    }
</style>

<body>
    <div class="div-purchase">
        <div class="div-item">
            <div class="item-photo">
                <img src="../images/<?php echo $data['foto'] ?>" alt="">
            </div>
            <div class="item-data">
                <h1 class="item-name"><?php echo $data['nome_livro']; ?></h1>
                <p class="item-author-year"><?php echo $data['autor'] . ' | ' . $data['ano_public']; ?></p>
                <p class="item-genre"><?php echo $data['categoria']; ?></p>
                <p class="item-isbn"><?php echo 'ISBN: ' . $data['ISBN'] ?></p>
                <p class="item-value"><?php echo 'R$' . $data['valor'] ?></>
                    <button class="btn btn-success">Comprar</button>
            </div>
        </div>
    </div>
</body>

</html>