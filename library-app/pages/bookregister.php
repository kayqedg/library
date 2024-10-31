<?php
session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    if (isset($_POST['submit'])) {
        include_once('config.php');
        $uploaddir = "../images/";
        $uploadfile = $uploaddir . basename($_FILES['cover']['name']);

        echo '<pre>';
        if (move_uploaded_file($_FILES['cover']['tmp_name'], $uploadfile)) {
            // $file_name = $_FILES['cover']['name'];
            // $book_title = $_POST['title'];
            // $author = $_POST['author'];
            // $genre = $_POST['genre'];
            // $isbn = $_POST['isbn'];
            // $public_year = $_POST['public-year'];
            // $price = $_POST['price'];
            // $stock = $_POST['stock'];
            // $sql = "INSERT INTO livros(foto, nome_livro, autor, categoria, isbn, ano_public, valor, qtd_estoque)
            // VALUES ($file_name, $book_title, $author, $genre, $isbn, $public_year, $price, $stock)";

        } else {
            echo "alert(Possible file upload attack!\n)";
        }
        echo 'Here is some more debugging info:';
        print_r($_FILES);
        unset($_POST);
        unset($_FILES);
        print "</pre>";

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
    <title>Book Register - Library</title>

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

    main {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    form {
        background-color: var(--white);
        border-radius: 5px;
        padding: 15px;

    }

    fieldset {
        padding: 2rem;
    }

    legend {
        text-align: center;
        padding: 10px;
        border-radius: 5px;
        background-color: var(--gray);
    }

    .btn {
        background-color: #88C273;
        padding: 5px;
        border-radius: 5px;
        border: none;
        transition: 0.3s;
        font-size: 20px;
    }

    .btn:hover {
        background-color: #A0D683;
    }

    input[type="text"],
    input[type="number"] {
        border: 1px solid gray;
        outline: none;
        padding: 2px;
    }
</style>

<body>
    <main>
        <form enctype="multipart/form-data" action="bookregister.php" method="post">
            <fieldset style="border-color:black !important; border-style:solid !important">
                <legend>Cadastro de Livro</legend>
                <label for="cover">Capa do livro:</label> <br>
                <input type="file" id="book--cover" name="cover" accept="image/png, image/jpeg" />
                <br> <br>
                <label for="title">Título do livro:</label> <br>
                <input type="text" name="title" id=""> <br>
                <label for="author">Autor do livro:</label> <br>
                <input type="text" name="author" id=""> <br>
                <label for="genre">Gênero do livro:</label> <br>
                <!-- NOTE: gerar de algum modo um arquivo que salve gêneros (ver JSON) e implantar os dados em um html select -->
                <input type="text" name="genre" id=""> <br>
                <label for="isbn">ISBN:</label> <br>
                <!-- NOTE: Criar uma máscara para ISBN aqui (opcional porém recomendado) -->
                <input type="text" name="isbn" id="isbn" placeholder="***-*-****-****-*"> <br>
                <label for="public-year">Ano de publicação:</label> <br>
                <!-- NOTE: Configurar para gerar automaticamente diversos anos -->
                <input type="text" name="public-year" id="public-year" maxlength="4"> <br>
                <label for="value">Valor:</label> <br>
                <!-- NOTE: Criar uma máscara para valores monetários aqui -->
                <input type="text" name="value" id="price" data-prefix="R$ " data - thousands="," data - decimal=".">
                <br>
                <label for="qtd_estoque">Estoque:</label> <br>
                <input type="number" name="stock" id="stock" min="0"> <br> <br>
                <input type="submit" name="submit" value="Cadastrar" class="btn">
            </fieldset>
        </form>
    </main>
</body>
<script>
    const inputPrice = document.getElementById('price')
    const inputYear = document.getElementById('public-year');
    const inputIsbn = document.getElementById('isbn');
    const stock = document.getElementById('stock')

    // TOOLS
    const now = new Date();
    const year = now.getFullYear();
    //

    stock.addEventListener('blur', () => {
        stock.value < 0 ? stock.value = 0 : stock.value = stock.value
    })

    inputPrice.addEventListener('keypress', e => {
        if (isNaN(e.key)) {
            e.preventDefault
        } else {
            let inputLength = inputPrice.value.length
            if (inputLength === 2) {
                inputPrice.value[0] = ','
            }
        }
    })

    inputYear.addEventListener('keypress', e => {
        if (isNaN(e.key)) {
            e.preventDefault();
        }
    })

    // ERROR: TENTAR FAZER ISSO FUNCIONAR
    inputYear.addEventListener('blur', () => {
        if (inputYear.value > year + 1) {
            inputYear.value = "";
        }
    })

    inputIsbn.addEventListener('keypress', e => {
        let inputLength = inputIsbn.value.length;
        isbn.maxLength = '17';
        if (isNaN(e.key)) {
            e.preventDefault();
        } else {
            if (inputLength === 3) {
                inputIsbn.value += '-';
            } else if (inputLength === 5) {
                inputIsbn.value += '-';
            } else if (inputLength === 10) {
                inputIsbn.value += '-';
            } else if (inputLength === 15) {
                inputIsbn.value += '-';
            }
        }

    });

    inputIsbn.addEventListener('blur', e => {
        let unformatted = inputIsbn.value.split('-').join('');
        let formatted = ''
        unformatted.split('').forEach((element, i) => {
            if (i === 3 || i === 4 || i === 8 || i === 12) {
                formatted += '-';
            }
            formatted += element;

            console.log(formatted);


        });
        inputIsbn.value = formatted;
    })


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script>
    $('#price').maskMoney();
</script>

</html>