<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Register - Library</title>
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

<body>
    <main>
        <label for="cover">Capa do livro:</label>
        <input type="file" name="cover" id="">
        <label for="title">Título do livro:</label>
        <input type="text" name="title" id="">
        <label for="author">Autor do livro:</label>
        <input type="text" name="author" id="">
        <label for="genre">Gênero do livro:</label>
        <!-- NOTE: gerar de algum modo um arquivo que salve gêneros (ver JSON) e implantar os dados em um html select -->
        <input type="text" name="genre" id="">
        <label for="isbn">ISBN:</label>
        <!-- NOTE: Criar uma máscara para ISBN aqui (opcional porém recomendado) -->
        <input type="text" name="isbn" id="">
        <label for="public-year">Ano de publicação:</label>
        <!-- NOTE: Configurar para gerar automaticamente diversos anos -->
        <select name="public-year" id="">
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
        </select> <br> <br>
        <label for="value">Valor:</label>
        <!-- NOTE: Criar uma máscara para valores monetários aqui -->
        <input type="text" name="value" id="">
        <label for="qtd_estoque"></label>
    </main>
</body>

</html>