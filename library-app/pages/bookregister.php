<?php ?>

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
        <form action="bookregister.php">
            <fieldset style="border-color:black !important; border-style:solid !important">
                <legend>Cadastro de Livro</legend>
                <label for="cover">Capa do livro:</label> <br>
                <input type="file" name="cover" id=""> <br> <br>
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
                <input type="text" name="" id="public-year" maxlength="4"> <br>
                <label for="value">Valor:</label> <br>
                <!-- NOTE: Criar uma máscara para valores monetários aqui -->
                <input type="text" name="value" id="price"> <br>
                <label for="qtd_estoque">Estoque:</label> <br>
                <input type="number" name="" id=""> <br> <br>
                <input type="submit" value="Cadastrar" class="btn">
            </fieldset>
        </form>
    </main>
</body>
<script>
    const inputPrice = document.getElementById('price')
    const inputYear = document.getElementById('public-year');
    const inputIsbn = document.getElementById('isbn');

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

    inputyear.addEventListener('keypress', e => {
        if (isNaN(e.key)) {
            e.preventDefault();
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
</script>

</html>