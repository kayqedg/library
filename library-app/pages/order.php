<?php
session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password']) && isset($_POST['submit'])) {
    include_once('config.php');
    $id_user = $_SESSION['id_user'];
    $id_book = $_POST['id_book'];
    $book_quantity = $_POST['book_quantity'];

    echo $id_user . ' ' . $id_book . ' ' . $book_quantity;

    $sqlBook = "SELECT * FROM livros WHERE id_livro = '$id_book'";
    $resultBook = $conexao->query($sqlBook);
    $dataBook = $resultBook->fetch_assoc();


} else {
    header('location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Finalizado</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
        font-family: "Poppins", sans-serif;
        font-weight: 300;
        font-style: normal;
        text-align: center;
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

    .item-data {
        text-align: justify;
        height: 100%;
        width: 100%;
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

    .item-purchase {
        float: right;
        padding: 2px;
    }
</style>

<body>
    <h1>Obrigado pela compra !</h1>
    <div class="div-purchase">
        <div class="div-item">
            <div class="item-photo">
                <img src="../images/<?php echo $dataBook['foto'] ?>" alt="">
            </div>
            <div class="item-data">
                <h1 class="item-name"><?php echo $dataBook['nome_livro']; ?></h1>
                <p class="item-author-year"><?php echo $dataBook['autor'] . ' | ' . $dataBook['ano_public']; ?></p>
                <p class="item-genre"><?php echo $dataBook['categoria']; ?></p>
                <p class="item-isbn"><?php echo 'ISBN: ' . $dataBook['ISBN'] ?></p>
                <!-- TAG: AQUI DEVERÁ SER MOSTRADO O VALOR COMPLETO DA COMPRA -->
                <p class="item-value"><?php echo 'R$' . $dataBook['valor'] ?>
                    <!-- TAG: A FAZER -->
                <p>QUANTIDADE COMPRADA</p>
                <!-- ----- -->
                <div class="item-purchase">
                </div>
            </div>
        </div>
    </div>
</body>

</html>