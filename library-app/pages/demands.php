<?php
session_start();
if (isset($_SESSION['name']) && isset($_SESSION['password']) && $_SESSION['user_level'] == 'admin') {
    include_once('config.php');
    require_once('functions.php');
    $sql = "SELECT
        pedidos.id_pedido,
        pedidos.fk_cliente,
        pedidos.fk_livro,
        livros.foto,
        clientes.nome,
        livros.nome_livro,
        pedidos.qtd,
        pedidos.valor,
        pedidos.data_pedido
    FROM 
        pedidos
    JOIN
        livros ON pedidos.fk_livro = livros.id_livro
    JOIN
    clientes ON pedidos.fk_cliente = clientes.id_cliente
    ORDER BY pedidos.data_pedido DESC
    ";
    $result = $conexao->query($sql);

    // $data = $result->fetch_assoc();

    if (isset($_GET['search'])) {
        // LINETAG: TERMINAR AQUI
        // NOTE: VER O QUE FAZER PARA IDENTIFICAÇÃO DO PEDIDO 
        // (SEM SER POR ID, VER ALGUM MODO DE CRIAR UM CÓDIGO DE PEDIDO)
        $key_values = ['livros.nome_livro', 'clientes.nome', ''];
        [$search, $key] = explode('/', $_GET['search']);

        if ($key >= 0 && $key < 5) {
            if ($key != 0) {
                $sqlSearch = "SELECT * 
        FROM livros
        WHERE 
        UPPER($key_values[$key]) LIKE UPPER('%$search%')";
            } else {
                $sqlSearch = "SELECT * 
                FROM livros
                WHERE 
                $key_values[$key] = $search";
            }
            $result = $conexao->query($sqlSearch);
        } else {
            header('location: stock.php');
        }
    }



} else {
    header('location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    .table {
        border-radius: 5px;
    }

    .table-img {
        width: 90px;
        height: 140px;
        object-fit: cover;
    }

    .table-cl {
        vertical-align: middle;
        font-size: 1.5rem;
    }

    .system-content {
        padding: 1.5rem;
    }
</style>

<body>

    <main class="system-div">
        <div class="system-nav">
            <a href="system.php"> Sistema</a>
            <a href="" class="<?php echo levelVerify($_SESSION['user_level']) ?>">
                Dashboard
            </a>
            <a href="shop.php"> Loja</a>
            <a href="history.php"> Histórico</a>
            <a href="stock.php" class="<?php echo levelVerify($_SESSION['user_level']) ?>">Estoque</a>
            <a href="demands.php" class="<?php echo levelVerify($_SESSION['user_level']) ?>">Pedidos</a>
        </div>
        <div class="system-content">
            <h1>Ordens</h1> <br> <br>
            <!-- TAG: CONTINUAR NAVBAR -->
            <!-- NAVBAR  -->
            <nav>
                <select class="search-slct" name="" id="">
                    <!-- id_cliente, nome, email, cpf, nivel  -->
                    <option value="0">nome_livro</option>
                    <option value="1">requisitor</option>
                    <option value="2">data</option>
                    <option value="3">gênero</option>
                    <option value="4">ano</option>

                </select>
                <input class="search-bar" type="text" name="search-bar" id="" placeholder="Pesquisar">
                <button class="btn btn-info search-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" onclick="" class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg></button>
            </nav>

            <!-- ///////////////////// -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id_pedido</th>
                        <th scope="col">foto</th>
                        <th scope="col">id_livro</th>
                        <th scope="col">livro</th>
                        <th scope="col">id_requisitor</th>
                        <th scope="col">requisitor</th>
                        <th scope="col">qtd</th>
                        <th scope="col">valor (R$)</th>
                        <th scope="col">data</th>
                        <!-- <th scope="col">*</th> -->
                    </tr>
                </thead>
                <tbody>
                    <!--
                    <tr class='table-row-0'>
                        <th class='table-cl' scope='row'>2</th>
                        <td class='table-cl'><img class='table-img' src='../images/1984.png' alt=''></td>
                        <td class='table-cl'>2</td>
                        <td class='table-cl'>1984</td>
                        <td class='table-cl'>3</td>
                        <td class='table-cl'>Jonas</td>
                        <td class='table-cl'>4</td>
                        <td class='table-cl'>159.60</td>
                        <td class='table-cl'>2024-11-01 16:48:07</td>
                    </tr>
                    -->

                    <?php
                    $switcher = 0;
                    while ($data = $result->fetch_assoc()) {
                        // print_r($data);
                    
                        echo "
                        <tr class='table-row-" . $switcher . "'>
                        <th class='table-cl' scope='row'>$data[id_pedido]</th>
                        <td class='table-cl'><img class='table-img' src='../images/$data[foto]' alt=''></td>
                        <td class='table-cl'>$data[fk_livro]</td>
                        <td class='table-cl'>$data[nome_livro]</td>
                        <td class='table-cl'>$data[fk_cliente]</td>
                        <td class='table-cl'>$data[nome]</td>
                        <td class='table-cl'>$data[qtd]</td>
                        <td class='table-cl'>$data[valor]</td>
                        <td class='table-cl'>$data[data_pedido]</td>";
                        $switcher == 1 ? $switcher = 0 : $switcher = 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
<script src="../js/search-bar.js"></script>

</html>