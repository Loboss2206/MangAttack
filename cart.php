<?php
include_once 'phpUtils/fct.php';
include_once 'phpUtils/connectDB.php';

if (!isset($_SESSION)) {
    session_start();
}

$resultIdCart = $conn->prepare("SELECT id FROM cart WHERE mail_user = '" . $_SESSION['identifier'] . "'");
$resultIdCart->execute();
$idCart = $resultIdCart->fetch(PDO::FETCH_NUM)[0];

if (isset($_POST['emptyCart'])) {
    emptyCart($idCart);
}

if (isset($_POST['purchaseCart'])) {
    createSummary($idCart);
    header("Location: summary.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mangattack</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cart.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
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
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {

                    $resultIdCart = $conn->prepare("SELECT id FROM cart WHERE mail_user = '" . $_SESSION['identifier'] . "'");
                    $resultIdCart->execute();
                    $resultIdCart = $resultIdCart->fetch(PDO::FETCH_NUM);

                    $resultCart = $conn->prepare("SELECT * FROM cart_volume WHERE id_cart = " . $resultIdCart[0]);
                    $resultCart->execute();

                    $totalPrice = 0;

                    while ($row = $resultCart->fetch(PDO::FETCH_NUM)) {
                        $id_volume = $row[1];
                        $quantity = $row[2];

                        $resultVolume = $conn->prepare("SELECT * FROM volume WHERE id = " . $id_volume);
                        $resultVolume->execute();
                        $resultVolume = $resultVolume->fetch(PDO::FETCH_NUM);

                        $resultManga = $conn->prepare("SELECT * FROM manga WHERE id = " . $resultVolume[2]);
                        $resultManga->execute();
                        $resultManga = $resultManga->fetch(PDO::FETCH_NUM);

                        $unitPrice = $resultVolume[4];
                        $price = $unitPrice * $quantity;
                        $totalPrice += $price;
                        $name = $resultManga[1] . ' - Tome ' . $resultVolume[1];
                        $img = $resultVolume[8];

                        echo '<div class="cart-item">
                                                <img class="img-manga" src="' . $img . '" alt="Manga 1">
                                                            <h3>' . $name . '</h3>
                                                            <p>' . $unitPrice . '€</p>
                                                            <p>' . $quantity . '</p>
                                                            <p>' . $price . '€</p>
                                                            <input type="submit" name="remove_cart_item" value="Retirer">
                                                        </div>';
                        echo "<br>";
                    }

                    if ($totalPrice == 0) {
                        echo 'Votre panier est vide';
                    }

                    echo '<div id="cart-total">
                                                    <p>Total : ' . $totalPrice . '€</p>
                                                    </div>';
                ?>

                <form action="cart.php" method="post">
                    <input id="emptyCart" type="submit" name="emptyCart" value="Vider le panier">
                </form>

                <?php if ($totalPrice != 0) { ?>

                <form action="cart.php" method="post">
                    <input id="orderCart" type="submit" name="purchaseCart" value="Passer commande">
                </form>

                <?php } else { ?>

                <form>
                    <input id="orderCart" type="submit" name="purchaseCart" value="Passer commande">
                </form>

                <?php }
                } else {
                    echo 'Vous devez être connecté pour accéder à votre panier';
                } ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>

    <script defer="defer" src="./js/cart.js"></script>
</body>

</html>