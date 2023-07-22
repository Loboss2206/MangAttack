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
    <link rel="stylesheet" href="css/cart.css">

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
        <section id="cart-presentation">
            <div id="cart-items">
                <?php
                $resultIdCart = $conn->prepare("SELECT id FROM cart WHERE mail_user = '" . $_SESSION['identifier'] . "'");
                $resultIdCart->execute();
                $resultIdCart = $resultIdCart->fetch(PDO::FETCH_NUM);

                $resultCart = $conn->prepare("SELECT * FROM cart_volume WHERE id_cart = " . $resultIdCart[0]);
                $resultCart->execute();
                print_r($resultCart);
                ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>
</body>

<?php
$resultIdCart = $conn->prepare("SELECT id FROM cart WHERE mail_user = '" . $_SESSION['identifier'] . "'");
$resultIdCart->execute();
$resultIdCart = $resultIdCart->fetch(PDO::FETCH_NUM);

echo $resultIdCart[0];

$resultCart = $conn->prepare("SELECT * FROM cart_volume WHERE id_cart = " . $resultIdCart[0]);
$resultCart->execute();
while ($row = $resultCart->fetch(PDO::FETCH_NUM)) {
    echo '#0' . $row[0];
    echo '#1' . $row[1];
    echo '#2#' . $row[2];
}

print_r($resultCart);
?>

</html>