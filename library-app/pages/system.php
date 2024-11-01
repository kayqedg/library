<?php

session_start();



if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    include_once('config.php');
    require_once('functions.php');

    $name = $_SESSION["name"];
    $password = $_SESSION["password"];

    $sql = "SELECT * FROM clientes WHERE nome = '$name'";
    $result = $conexao->query($sql);
    $data = $result->fetch_assoc();
    $_SESSION['id_user'] = $data["id_cliente"];
    $_SESSION['user_level'] = $data["nivel"];

    $id_user = $_SESSION["id_user"];
    $user_level = $_SESSION['user_level'];

    if ($user_level == 'admin') {
        $sqlTable = 'SELECT id_cliente, nome, email, cpf, nivel FROM clientes';
        $resultTable = $conexao->query($sqlTable);
    }




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

    /* 
    .table {
        background-color: #939185;
        margin-right: 10rem;
    }

    .table-row-0 {
        background-color: #ffffff;
    }

    .table-row-1 {
        background-color: #F5F5F7;
    } */

    .btn {
        margin-inline: 2px;
    }

    .confirm-modal {
        z-index: 6;
        position: absolute;
        background-color: white;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        padding: 1rem;
        border-radius: 5px;
    }

    .modal-btns {
        float: right;
        margin-inline: 2rem;
        margin-bottom: 1rem;
    }

    .modal-content {
        text-align: justify;
        border: none;
        margin: 5px;
        font-size: 20px;
    }

    .confirm-overlay {
        z-index: 2;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    /* .confirm-modal {
        z-index: 3;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 1);
        font-size: 2rem;
    } */
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
            <a href="demands.php" class="<?php echo levelVerify($_SESSION['user_level']) ?>">Pedidos</a>
        </div>
        <div class="system-content">

            <h1 class="title">Library</h1>
            <h2 class="title">Seja bem vindo <?php echo $name ?></h2>
            <p><?php echo $user_level ?></p>
            <!-- <p><?php echo $id_user ?></p> -->
            <a href="exit.php" class="btn btn-danger">Sair</a> <br> <br>
            <div class="<?php echo levelVerify($user_level) ?>">
                <h1>Usuários Ativos</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">email</th>
                            <th scope="col">cpf</th>
                            <th scope="col">nivel</th>
                            <th scope="col">*</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr class="table-row-0">
                            <th scope="row">1</th>
                            <td>admin</td>
                            <td>admin@email.com</td>
                            <td>00000000000</td>
                            <td>admin</td>
                            <td>
                                <button class="btn btn-sm btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </button>
                                <button class="btn btn-sm btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                    </svg></button> -->
                        <?php
                        $classSwitch = 0;
                        while ($data_table = $resultTable->fetch_assoc()) {

                            echo "<tr class='table-row-" . $classSwitch . "'>";
                            echo "<th scope='row'>$data_table[id_cliente]</th>";
                            echo "<td>$data_table[nome]</td>";
                            echo "<td>$data_table[email]</td>";
                            echo "<td>$data_table[cpf]</td>";
                            echo "<td>$data_table[nivel]</td>";
                            echo "<td>";
                            echo "<a href='edituser.php?id=$data_table[id_cliente]' class='btn btn-sm btn-primary'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                        class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path
                                            d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                                        <path fill-rule='evenodd'
                                            d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z' />
                                    </svg>
                                </a>";
                            echo "<button class='btn btn-sm btn-danger btn-delete' " . (($data_table['nivel'] == 'admin') ? 'disabled' : '') . " ><svg xmlns='http://www.w3.org/2000/svg' width='16'
                                        height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path
                                            d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0' />
                                    </svg></button>";
                            echo "</td>";
                            echo "</tr>";

                            // if ($data_table['id_cliente'] > 1) {
                        
                            echo "
                            <div class='confirm-overlay hidden'> 
                            <div class='confirm-modal'>
                                <h1>Deletar Usuário</h1>
                                <hr>
                                <div class='modal-content'>
                                    <p>&emsp;Você tem certeza de que deseja deletar esse usuário? Note que esta ação não
                                        poderá
                                        ser
                                        revertida!</p>
                                </div>
                                <hr>
                                <div class='modal-btns'>
                                    <button class='btn btn-success btn-back'>Voltar</button>
                                    <a href='deleteuser.php?id=$data_table[id_cliente]' class='btn btn-danger btn-confirm-delete'>Deletar</a>
                                </div>
                            </div>
                        </div>";
                            // }
                        


                            $classSwitch == 0 ? $classSwitch = 1 : $classSwitch = 0;
                        }
                        ?>

                        <!-- TESTE JANELA MODAL -->
                        <!-- <div class='confirm-overlay hidden'> 
                            <div class='confirm-modal'>
                                <h1>Deletar Usuário</h1>
                                <hr>
                                <div class='modal-content'>
                                    <p>&emsp;Você tem certeza de que deseja deletar esse usuário? Note que esta ação não
                                        poderá
                                        ser
                                        revertida!</p>
                                </div>
                                <hr>
                                <div class='modal-btns'>
                                    <button class='btn btn-success btn-back'>Voltar</button>
                                    <a href='deleteuser.php?id=' class='btn btn-danger btn-confirm-delete'>Deletar</a>
                                </div>
                            </div>
                        </div> -->
                    </tbody>
                </table>
            </div>
        </div>
        </div> <br>
        <!-- AQUI DEVERÁ SER MOSTRADO TODAS AS CONTAS ATIVAS -->
        <!-- SE O USUÁRIO FOR DE NÍVEL --ADMIN-- -->

    </main>
</body>

<script>
    const modal = document.querySelector('.confirm-modal');
    const overlays = document.querySelectorAll('.confirm-overlay');
    const btnsBack = document.querySelectorAll('.btn-back');
    const btnsDelete = document.querySelectorAll('.btn-delete');
    const btnConfirm = document.querySelector('.btn-confirm-delete');

    for (let i = 0; i < btnsBack.length; i++)
        btnsBack[i].addEventListener('click', function () {
            overlays[i].classList.add('hidden');
        }
        )

    for (let i = 0; i < btnsDelete.length; i++) {
        btnsDelete[i].addEventListener('click', function () {
            overlays[i].classList.remove('hidden')
        });
    }
</script>

</html>