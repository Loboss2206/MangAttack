<?php
include_once 'phpUtils/connectDB.php';
include_once 'phpUtils/fct.php';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['id'])) {
    $_SESSION['tome_id'] = $_GET['id'];
}

if (isset($_SESSION['identifier'])) {
    $resultIdKart = $conn->prepare("SELECT id FROM cart WHERE mail_user = '" . $_SESSION['identifier'] . "'");
    $resultIdKart->execute();
    $resultIdKart = $resultIdKart->fetch(PDO::FETCH_NUM);
} /* else {
    header('Location: login.php');
} */

if (isset($_POST['add_to_kart'])) {
    $quantity = $_POST['quantity'];
    $tome_id = $_SESSION['tome_id'];
    $kart_id = $resultIdKart[0];

    addToKart($tome_id, $kart_id, $quantity);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mangattack</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/manga.css">
</head>

<body>
    <!-- Header -->
    <?php
    include_once 'phpUtils/header.php';
    ?>

    <!-- Main -->
    <main>
        <section id="grid-presentation">
            <div id="grid">
                <?php
                $resultTome = $conn->prepare("SELECT * FROM volume WHERE id = " . $_SESSION['tome_id'] . " ORDER BY id DESC LIMIT 1");
                $resultTome->execute();
                $resultTome = $resultTome->fetch(PDO::FETCH_NUM);

                $resultManga = $conn->prepare("SELECT * FROM manga WHERE id = " . $resultTome[2] . " ORDER BY id DESC LIMIT 1");
                $resultManga->execute();
                $resultManga = $resultManga->fetch(PDO::FETCH_NUM);

                echo '
            <img id="img-presentation" src="' . $resultTome[8] . '" alt="' . $resultManga[1] . $resultTome[1] . '">';
                echo '<div id="text-presentation">';

                echo
                '<h2>Tome ' . $resultTome[1] . ' - ' . $resultManga[1] . '</h2>
                <h3>' . $resultTome[3] . '</h3>
                <p>Auteur : ' . $resultManga[2] . '</p>
                <p>Prix : ' . $resultTome[4] . '€</p>
                <p>Catégorie : Shonen</p>
                <p>Genre : Aventure</p>
                <p>Éditeur : ' . $resultTome[6] . '</p>
                <p>Nombre de pages : ' . $resultTome[7] . '</p>
                <p>Disponibilité : En stock</p>'
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
            </div>
        </section>
        <section id="more-info">
            <h2 class="title-section">Description</h2>
            <div id="description">
                <?php echo $resultManga[3] ?>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script defer="defer" src="./js/manga.js"></script>
    <script src="js/main.js" type="module"></script>
</body>

</html>