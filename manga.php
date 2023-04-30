<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mangattack</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/manga.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script defer="defer" src="./js/manga.js"></script>
</head>

<body>
    <!-- Header -->
    <?php
    include_once 'header.php';
    ?>

    <!-- Main -->
    <main>
        <section id="grid-presentation">
            <img id="img-presentation" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 1">
            <div id="text-presentation">
                <?php
                include_once 'connectDB.php';

                $resultTome = $conn->prepare("SELECT * FROM tome WHERE id = " . $_GET['id'] . " ORDER BY id DESC LIMIT 1");
                $resultTome->execute();
                $resultTome = $resultTome->fetch(PDO::FETCH_NUM);

                $resultManga = $conn->prepare("SELECT * FROM manga WHERE id = " . $resultTome[2] . " ORDER BY id DESC LIMIT 1");
                $resultManga->execute();
                $resultManga = $resultManga->fetch(PDO::FETCH_NUM);

                echo
                "<h2>Tome " . $resultTome[1] . " - " . $resultManga[1] . "</h2>
                <h3>" . $resultTome[3] . "</h3>
                <p>Auteur : " . $resultManga[2] . "</p>
                <p>Prix : 10€</p>
                <p>Catégorie : Shonen</p>
                <p>Genre : Aventure</p>
                <p>Éditeur : Glénat</p>
                <p>Nombre de pages : 200</p>
                <p>Disponibilité : </p>
                <p id='etat'>En stock</p>"
                ?>

                <div id="addToCart">
                    <button class="grid-item buttonChange" id="buttonMinus">-</button>
                    <input class="grid-item" id="inputQuantity" type="number" value="1" min="0">
                    <button class="grid-item buttonChange" id="buttonPlus">+</button>
                    <button class="grid-item" id="buttonCart">Ajouter au panier</button>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'footer.php';
    ?>
</body>

</html>