<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Loja</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
    main {
        justify-content: center;
        flex-direction: row;
    }

    .products-div {
        display: grid;
        grid-template-columns: repeat(4, 200px);
        grid-gap: 10px;
        grid-auto-rows: minmax(300px, auto);
        margin-top: 1rem;

    }

    .prod-box {
        border-radius: 5px;
        grid-row: span 1;
        grid-column: span 1;
        background-color: rgba(0, 0, 0, 0.3);
    }

    .prod-box:hover {}

    .prod-img {
        width: 100%;
        height: 75%;
        object-fit: cover;
        border-radius: 5px 5px 0 0;
    }

    /* --- TESTE --- */
    .system-div-2 {
        display: flex;
        flex-direction: row;
    }

    .system-nav-2 {
        display: flex;
        flex-direction: column;
        position: fixed;
        height: 100%;
        background-color: var(--brown);
        top: 0;
        left: 0;
        padding-top: 40px;
        margin-right: 1rem;
    }

    .system-nav-2 a {
        text-decoration: none;
        font-size: 2rem;
        padding: 8px 32px 8px 20px;
        color: var(--white);
    }

    .system-content-2 {
        height: 100%;
    }
</style>

<body>
    <main class="system-div-2">
        <div class="system-nav-2">
            <a href=""><img src="" alt="">Dashboard</a>
            <a href=""><img src="" alt="">Dashboard</a>
            <a href="shop.php"><img src="" alt="">Comprar</a>
            <a href=""><img src="" alt="">Dashboard</a>
            <a href=""><img src="" alt="">Dashboard</a>
        </div>
        <div class="system-content-2">
            <div class="products-div">
                <div class="prod-box">
                    <img class="prod-img" src="../1984.png" alt="">
                    <div class="prod-data">
                        <h3 class="prod-name">Product Name</h3>
                        <p class="prod-value">R$ 10.00</p>
                    </div>
                </div>
                <div class="prod-box">
                    <img class="prod-img" src="../1984.png" alt="">
                    <div class="prod-data">
                        <h3 class="prod-name">Product Name</h3>
                        <p class="prod-value">R$ 10.00</p>
                    </div>
                </div>
                <div class="prod-box">
                    <img class="prod-img" src="../1984.png" alt="">
                    <div class="prod-data">
                        <h3 class="prod-name">Product Name</h3>
                        <p class="prod-value">R$ 10.00</p>
                    </div>
                </div>
                <div class="prod-box">
                    <img class="prod-img" src="../1984.png" alt="">
                    <div class="prod-data">
                        <h3 class="prod-name">Product Name</h3>
                        <p class="prod-value">R$ 10.00</p>
                    </div>
                </div>
                <div class="prod-box">
                    <img class="prod-img" src="../1984.png" alt="">
                    <div class="prod-data">
                        <h3 class="prod-name">Product Name</h3>
                        <p class="prod-value">R$ 10.00</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>