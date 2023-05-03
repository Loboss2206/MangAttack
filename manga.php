<?php
include_once 'phpUtils/connectDB.php';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['id'])) {
    $_SESSION['tome_id'] = $_GET['id'];
}

if (isset($_SESSION['identifier'])) {
    $resultIdKart = $conn->prepare("SELECT id FROM panier WHERE mail_client = '" . $_SESSION['identifier'] . "'");
    $resultIdKart->execute();
    $resultIdKart = $resultIdKart->fetch(PDO::FETCH_NUM);
} /* else {
    header('Location: login.php');
} */

if (isset($_POST['add_to_kart'])) {
    $quantity = $_POST['quantity'];
    $tome_id = $_SESSION['tome_id'];
    $kart_id = $resultIdKart[0];

    echo "iciiiiiiiiiiiii" . $quantity . " " . $tome_id . " " . $kart_id;

    $stmt = $conn->prepare("INSERT INTO panier_tome (id_tome, quantite, id_panier) VALUES (" . $tome_id . "," . $quantity . "," . $kart_id . ")");
    $stmt->execute();
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
    include_once 'phpUtils/header.php';
    ?>

    <!-- Main -->
    <main>
        <section id="grid-presentation">
            <img id="img-presentation" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 1">
            <div id="text-presentation">
                <?php
                $resultTome = $conn->prepare("SELECT * FROM tome WHERE id = " . $_SESSION['tome_id'] . " ORDER BY id DESC LIMIT 1");
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

                <?php
                $resultIdKart = $conn->prepare("SELECT id FROM panier WHERE mail_client = '" . $_SESSION['identifier'] . "'");
                $resultIdKart->execute();
                $resultIdKart = $resultIdKart->fetch(PDO::FETCH_NUM);
                ?>

                <form method="post" action="manga.php">
                    <div id="addToCart">
                        <button class="grid-item buttonChange" id="buttonMinus" type="button">-</button>
                        <input class="grid-item" id="inputQuantity" type="number" value="1" min="1" name="quantity">
                        <button class="grid-item buttonChange" id="buttonPlus" type="button">+</button>
                        <button type="submit" class="grid-item" id="buttonCart" name="add_to_kart">Ajouter au panier</button>
                    </div>
                </form>

            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>
</body>

</html>