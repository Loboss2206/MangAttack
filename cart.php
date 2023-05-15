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
                $resultIdKart = $conn->prepare("SELECT id FROM cart WHERE mail_user = '" . $_SESSION['identifier'] . "'");
                $resultIdKart->execute();
                $resultIdKart = $resultIdKart->fetch(PDO::FETCH_NUM);

                $resultKart = $conn->prepare("SELECT * FROM cart_volume WHERE id_cart = " . $resultIdKart[0]);
                $resultKart->execute();
                print_r($resultKart);
                ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>
</body>

</html>