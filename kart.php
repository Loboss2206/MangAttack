<?php
include_once 'phpUtils/fct.php';
include_once 'phpUtils/connectDB.php';

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
    <link rel="stylesheet" href="css/kart.css">

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
        <section id="kart-presentation">
            <div id="kart-items">
                <?php
                $resultIdKart = $conn->prepare("SELECT id FROM panier WHERE mail_client = '" . $_SESSION['mail'] . "'");
                $resultIdKart->execute();
                $resultIdKart = $resultIdKart->fetch(PDO::FETCH_NUM);
                ?>

                <div id="addToCart">
                    <button class="grid-item buttonChange" id="buttonMinus">-</button>
                    <input class="grid-item" id="inputQuantity" type="number" value="1" min="1">
                    <button class="grid-item buttonChange" id="buttonPlus">+</button>
                    <?php
                    echo '<button onclick="addToKart(' . $_GET['id'] . ',' . $resultIdKart . ',3)" class="grid-item" id="buttonCart">Ajouter au panier</button>';
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>
</body>

</html>