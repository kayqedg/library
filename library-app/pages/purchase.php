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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Compra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
    :root {
        --white: #faf7f0;
        --gray: #d8d2c2;
        --brown: #b17457;
        --lightbrown: #b99470;
        --black: #4a4947;
    }

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

    .item-data {
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

    .input-quantity {
        border: 2px solid black;
        width: 3rem;
        border-radius: 5px;
    }

    .purchase-form {
        position: relative;
        display: flex;
        flex-direction: row;
        gap: 2px;
    }

    /* MODAL */
    .overlay {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.3);
        height: 100%;
        width: 100%;
        z-index: 2;
        backdrop-filter: blur(10px);
    }

    .modal-win {
        border-radius: 5px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 3;
        background-color: var(--white);
        padding: 1rem;
    }

    .btn {
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
                <p class="item-value"><?php echo 'R$' . $data['valor'] ?>
                <p class="item-quantity"><?php echo 'Estoque: ' . $data['qtd_estoque'] ?></p>
                <div class="item-purchase">
                    <form action="order.php" method="post" class="purchase-form">
                        <input class="input-quantity" min="1" max="<?php echo $data['qtd_estoque'] ?>" value="1"
                            type="number" name="book_quantity" id="">
                        <input type="text" name="id_book" value="<?php echo $data['id_livro'] ?> " hidden>
                        <input type="submit" name="submit" id="submit" value="Comprar" class="btn btn-success">
                        <p id='max--value' class="hidden" style><?php echo $data['qtd_estoque'] ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay hidden">
        <div class="modal-win">
            <h1 class="modal-h1">Produto Esgotado</h1>
            <hr>
            <p class="modal-txt">Que pena! O livro <?php echo $data['nome_livro'] ?> está esgotado. Por favor, espere
                mais alguns dias
                até repormos o
                estoque.</p>
            <hr>
            <a href="shop.php" class="btn btn-success">Voltar para loja</a>
        </div>
    </div>

</body>
<script>
    const submit = document.getElementById('submit')
    const qtdCompra = document.querySelector('.input-quantity');
    const maxValue = document.getElementById('max--value');
    const overlay = document.querySelector('.overlay');
    const form = document.querySelector('.purchase-form')

    if (Number(maxValue.textContent) === 0) {

        qtdCompra.setAttribute("disabled", true);
        submit.setAttribute("disabled", true)
        overlay.classList.remove('hidden')
    }


    qtdCompra.addEventListener('blur', function () {
        if (qtdCompra.value > Number(maxValue.textContent)) {
            qtdCompra.value = Number(maxValue.textContent)
        }

        if (qtdCompra.value < 1) {
            qtdCompra.value = 1
        }
    })
</script>

</html>