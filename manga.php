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
    $resultIdCart = $conn->prepare("SELECT id FROM cart WHERE mail_user = '" . $_SESSION['identifier'] . "'");
    $resultIdCart->execute();
    $resultIdCart = $resultIdCart->fetch(PDO::FETCH_NUM);
} /* else {
    header('Location: login.php');
} */

if (isset($_POST['add_to_cart'])) {
    echo 'test';
    $quantity = $_POST['quantity'];
    $tome_id = $_SESSION['tome_id'];
    $cart_id = $resultIdCart[0];

    addToCart($tome_id, $cart_id, $quantity);
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
                $resultVolume = $conn->prepare("SELECT * FROM volume WHERE id = " . $_SESSION['tome_id'] . " ORDER BY id DESC LIMIT 1");
                $resultVolume->execute();
                $resultVolume = $resultVolume->fetch(PDO::FETCH_NUM);

                $resultManga = $conn->prepare("SELECT * FROM manga WHERE id = " . $resultVolume[2] . " ORDER BY id DESC LIMIT 1");
                $resultManga->execute();
                $resultManga = $resultManga->fetch(PDO::FETCH_NUM);

                echo '<img id="img-presentation" src="' . $resultVolume[8] . '" alt="' . $resultManga[1] . $resultVolume[1] . '">';
                echo '<div id="text-presentation">';

                echo
                '<div id="titles">
                <h2>Tome ' . $resultVolume[1] . ' - ' . $resultManga[1] . '</h2>
                <h3>' . $resultVolume[3] . '</h3>
                </div>
                <div id="infos">
                <p>Auteur : ' . $resultManga[2] . '</p>
                <p>Prix : ' . $resultVolume[4] . '€</p>
                <p>Catégorie : ';

                $resultIdCategory = $conn->prepare("SELECT id_category FROM manga_category WHERE id_manga = " . $resultManga[0]);
                $resultIdCategory->execute();
                $resultIdCategory = $resultIdCategory->fetchAll(PDO::FETCH_NUM)[0];

                $resultCategory = $conn->prepare("SELECT name FROM category WHERE id = " . $resultIdCategory[0]);
                $resultCategory->execute();
                $resultCategory = $resultCategory->fetch(PDO::FETCH_NUM)[0];

                echo '</p>
                <p>Genre : ';

                $resultKinds = $conn->prepare("SELECT id_kind FROM manga_kind WHERE id_manga = " . $resultManga[0]);
                $resultKinds->execute();
                $resultKinds = $resultKinds->fetchAll(PDO::FETCH_NUM);

                $indexRand = array_rand($resultKinds, min(3, sizeof($resultKinds)));
                $kinds = [];
                $first = true;
                foreach ($indexRand as $index) {
                    if (!$first) {
                        echo ', ';
                    } else {
                        $first = false;
                    }

                    $kinds[] = $resultKinds[$index];
                    $resultKind = $conn->prepare("SELECT name FROM kind WHERE id = " . $resultKinds[$index][0]);
                    $resultKind->execute();
                    $resultKind = $resultKind->fetch(PDO::FETCH_NUM)[0];
                    echo $resultKind;
                }

                echo '</p>';

                if ($resultVolume[5] > 0) {
                    echo '<p id="available" style="background-color:cornflowerblue">&#x2713; Cet article est actuellement disponible</p>';
                } else {
                    echo '<p id="available" style="background-color:#eb3232">&#x2717; Cet article n\'est actuellement pas disponible</p>';
                }

                echo '</div>';
                ?>

                <form method="post" action="manga.php">
                    <div id="addToCart">
                        <button class="grid-item buttonChange" id="buttonMinus" type="button">-</button>
                        <input class="grid-item" id="inputQuantity" type="number" value="1" min="1" name="quantity">
                        <button class="grid-item buttonChange" id="buttonPlus" type="button">+</button>
                        <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
                            echo '<button type="submit" class="grid-item" id="buttonCart" name="add_to_cart">Ajouter au panier</button>';
                        } else {
                            echo '<button type="button" class="grid-item buttonCart_disconnected" id="buttonCart" name="add_to_cart">Ajouter au panier</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
            </div>
        </section>
        <section id="more-info">
            <div class="menu">
                <button class="menu-item active" data-target="description">Description</button>
                <button class="menu-item" data-target="details">Details techniques</button>
                <button class="menu-item" data-target="reviews">Avis</button>
                <!-- Ajoutez d'autres boutons pour d'autres options si nécessaire -->
            </div>
            <div class="box" id="description">
                <?php echo $resultManga[3] ?>
            </div>
            <div class="box" id="details" style="display: none;">
                <?php
                echo '<p>Éditeur : ' . $resultVolume[6] . '</p>
                <p>Nombre de pages : ' . $resultVolume[7] . '</p>'
                ?>
            </div>
            <div class="box" id="reviews" style="display: none;">
                <p>Aucun avis sur ce tome pour le moment...</p>
            </div>
        </section>


    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="js/manga.js" type="module"></script>
</body>

</html>