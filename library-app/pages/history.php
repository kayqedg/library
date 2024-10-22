<?php

session_start();



if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    include_once('config.php');
    require_once('functions.php');

    $name = $_SESSION["name"];
    $password = $_SESSION["password"];


    $id_user = $_SESSION["id_user"];
    $user_level = $_SESSION['user_level'];

    $sql =
        "SELECT
        livros.foto,
        livros.nome_livro,
        livros.autor,
        pedidos.qtd,
        pedidos.valor,
        pedidos.data_pedido
    FROM 
        pedidos
    JOIN
        livros ON pedidos.fk_livro = livros.id_livro
    WHERE 
        pedidos.fk_cliente = '$id_user'";
    $result = $conexao->query($sql);

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
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .table {
        background-color: #939185;
        margin-right: 10rem;
    }

    .table-row-0 {
        background-color: #ffffff;
    }

    .table-row-1 {
        background-color: #F5F5F7;
        /* background-color: #B7B7B7; */
        /* background-color: #dbdbd9; */
    }

    .btn {
        margin-inline: 2px;
    }

    .table-img {
        width: 150px;
        height: 200px;
        object-fit: cover;
    }

    .table-cl {
        vertical-align: middle;
        font-size: 1.5rem;
    }

    .nopurchases-label {
        margin-top: 5rem;
        text-align: center;
        vertical-align: middle;

    }
</style>

<body>
    <main class='system-div'>
        <div class="system-nav">
            <a href="system.php"> Sistema</a>
            <a href="" class="<?php echo levelVerify($_SESSION['user_level']) ?>">
                Dashboard
            </a>
            <a href="shop.php"> Loja</a>
            <a href="history.php"> Histórico</a>
            <a href="stock.php" class="<?php echo levelVerify($_SESSION['user_level']) ?>">Estoque</a>
        </div>
        <div class="system-content">

            <h1 class="title">Histórico</h1>
            <br><br>
            <h1 class="<?php echo levelVerify($_SESSION['user_level']) ?>">Seus Pedidos:</h1>
            <br>

            <?php
            if ($result->num_rows > 0) {
                echo "<table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>capa</th>
                        <th scope='col'>pedido</th>
                        <th scope='col'>autor</th>
                        <th scope='col'>qtd</th>
                        <th scope='col'>valor</th>
                        <th scope='col'>data</th>
                    </tr>
                </thead>
                <tbody>";
                while ($data = $result->fetch_assoc()) {
                    echo "<tr class='table-row-0'>
                                    <td>
                                    <img src='../images/$data[foto]' alt='foto do livro' class='table-img'>
                                    </td>
                                    <td class='table-cl'>$data[nome_livro]</td>
                                    <td class='table-cl'>$data[autor]</td>
                                    <td class='table-cl'>$data[qtd]</td>
                                    <td class='table-cl'>$data[valor]</td>
                                    <td class='table-cl'>$data[data_pedido]</td>
                                </tr>";
                }
                echo "
                    </tbody>
                    </table>";
            } else {
                echo "<h1 class='nopurchases-label'>Você não tem nenhum pedido, faça um em nossa <a href='shop.php'>Loja</a></h1>";
            }
            ?>

        </div> <br>


    </main>
</body>

<script>

</script>

</html>