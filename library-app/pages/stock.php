<?php
session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    include_once('config.php');
    require_once('functions.php');

    $sql = 'SELECT * FROM livros';
    $result = $conexao->query($sql);




    if (isset($_POST['submit'])) {
        if ((isset($_POST['correct']) && !isset($_POST['add'])) || (!isset($_POST['correct']) && isset($_POST['add']))) {
            // NOTE: Achei que essa aparente redundância deixaria o código mais bem organizado 
            $id_book = $_POST['id'];
            $qtt_book = $_POST['qtt']; //var criada anteriormente para JS (provavelmente sem utilidade aqui)
            $row = $result->fetch_assoc();

            if (isset($_POST['correct']) && !isset($_POST['add'])) {
                $correct = $_POST['correct'];
                $sql_update = "UPDATE livros SET qtd_estoque = '$correct' WHERE id_livro = '$id_book'";
                $result_update = $conexao->query($sql_update);
                header('location: updateform.php');
                $result = $conexao->query($sql);
            } else if (!isset($_POST['correct']) && isset($_POST['add'])) {
                $add = $_POST['add'];
                $sql_update = "UPDATE livros SET qtd_estoque = qtd_estoque + $add  WHERE $id_book = '$id_book'";
                $result_update = $conexao->query($sql_update);
                $result = $conexao->query($sql);
                header('location: updateform.php');
            }



        } else {
            echo "<script>alert('Erro! Dois valores foram inseridos')</script>";
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
    <title>Stock - Library</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
        </script>
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



    .table-img {
        width: 75px;
        height: 125px;
        object-fit: cover;
    }

    .table-cl {
        vertical-align: middle;
        font-size: 1.5rem;
    }

    .system-content {
        padding: 1.5rem;
    }

    .buttons {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding-inline: 1.5rem;
    }

    .btn-sm {
        width: 35px;
        height: 35px;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .edit-overlay {
        z-index: 2;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.4);
        width: 100%;
        height: 100%;
        backdrop-filter: blur(10px);
        top: 0;
        left: 0;
    }

    .edit-modal {
        z-index: 6;
        position: absolute;
        background-color: #F5F5F7;
        left: 50%;
        top: 50%;
        width: 20%;
        min-width: 20%;
        transform: translate(-50%, -50%);
        padding: 1rem;
        padding-inline: 2rem;
        border-radius: 5px;
        text-align: left;
    }

    .radio {
        text-align: left;
    }

    .number {
        margin-left: 2rem;
    }

    .tip {
        margin: -1rem;
        color: #758694;
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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">foto</th>
                        <th scope="col">nome</th>
                        <th scope="col">autor</th>
                        <th scope="col">gênero</th>
                        <th scope="col">valor</th>
                        <th scope="col">ano public</th>
                        <th scope="col">qtd</th>
                        <th scope="col">*</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="edit-overlay hidden">
                        <div class="edit-modal">
                            <h1>Correção de estoque</h1>
                            <hr>
                            <form action="stock.php" method="post">
                                <input type="hidden" name="id" id="book--id" value="0">
                                <input type="hidden" name="qtt" id="book--qtt" value="0">
                                <input type="radio" class="radio" name="change-value" onclick="displayCor(this)"
                                    id="enable--correction" checked>
                                <label for="enable--correction"> Corrigir:</label> <br>
                                <input type="number" class="number" name="correct" id="correct" min="0"><br> <br>
                                <input type="radio" class="radio" name="change-value" onclick="displayAdd(this)"
                                    id="enable--add">
                                <label for="enable--add">Adicionar/Remover:</label> <br>
                                <input type="number" class="number" name="add" id="add" disabled><br> <br>
                                <input type="submit" class="btn btn-success btn-submit" style="float: right;"
                                    value="Atualizar" name="submit" id="submit">
                            </form>
                            <button class="btn btn-danger btn-back"
                                style="float: right; margin-right: 5px;">Voltar</button> <br><br>
                            <hr>

                        </div>
                    </div>
                    <?php
                    $switcher = 0;
                    while ($data = $result->fetch_assoc()) {
                        echo "<tr class='table-row-" . $switcher . "'>";
                        echo "
                        <th scope='row' class='table-cl'>$data[id_livro]</th>
                        <td><img class='table-img' src='../images/$data[foto]' alt=''></td>
                        <td class='table-cl'>$data[nome_livro]</td>
                        <td class='table-cl'>$data[autor]</td>
                        <td class='table-cl'>$data[categoria]</td>
                        <td class='table-cl'>$data[valor]</td>
                        <td class='table-cl'>$data[ano_public]</td>
                        <td class='table-cl'>$data[qtd_estoque]</td>
                        ";
                        echo "                        
                        <td class='table-cl'>
                            <div class='buttons'>
                                <button class='btn btn-sm btn-primary btn-edit' id='$data[id_livro]-$data[qtd_estoque]'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                        class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path
                                            d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                                        <path fill-rule='evenodd'
                                            d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z' />
                                    </svg>
                                </button>
                            </div>
                        </td>";
                        echo "</tr>";
                        $switcher == 1 ? $switcher = 0 : $switcher = 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

<script>
    // enable / disable inputs
    const enableCorr = document.getElementById('enable--correction');

    const numCor = document.getElementById('correct');
    const numAdd = document.getElementById('add');

    function displayCor(e) {
        numCor.disabled = false
        numAdd.value = ''
        numAdd.disabled = true
    }
    function displayAdd(e) {
        numCor.disabled = true
        numCor.value = ''
        numAdd.disabled = false
    }



    // take id & quantity from book

    function clearAll() {
        enableCorr.checked = true
        numCor.disabled = false
        numAdd.value = ''
        numAdd.value = ''
        numAdd.disabled = true
    }

    const btnsEdit = document.querySelectorAll('.btn-edit');
    const inputId = document.getElementById('book--id');
    const inputQtt = document.getElementById('book--qtt');
    const editOverlay = document.querySelector('.edit-overlay');
    const btnBack = document.querySelector('.btn-back');
    const submit = document.getElementById('.submit');


    for (let i = 0; i < btnsEdit.length; i++) {
        btnsEdit[i].addEventListener('click', function () {
            let dataArray = btnsEdit[i].id.split('-')
            editOverlay.classList.remove('hidden')
            document.body.style.overflow = 'hidden';
            clearAll();
            inputId.value = dataArray[0]
            inputQtt.value = dataArray[1]
            numAdd.setAttribute('min', -dataArray[1])



        });

    }

    numAdd.addEventListener('blur', function () {
        console.log('macaco');

        if (numAdd.value < -inputQtt.value) {
            numAdd.value = -inputQtt.value;
        }
    });

    numCor.addEventListener('blur', function () {
        if (numCor.value < 0) {
            numCor.value = 0
        }

    })

    editOverlay.addEventListener('click', function (e) {
        if (e.target === this) {
            editOverlay.classList.add('hidden');
            clearAll();
            document.body.style.overflow = 'auto';
        }
    });
    btnBack.addEventListener('click', function (e) {
        editOverlay.classList.add('hidden');
        clearAll();
        document.body.style.overflow = 'auto';
    });



</script>


</html>