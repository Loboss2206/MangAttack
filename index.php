<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'fct.php';
include_once 'connectDB.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mangattack</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- Header -->
    <?php
    include_once 'header.php';
    ?>

    <!-- Main -->
    <main>
        <section id="featured">
            <h2 class="title-section">Les Nouveautés</h2>
            <div id="grid-featured">
                <?php
                $resultTomes = $conn->prepare("SELECT * FROM tome ORDER BY id ASC LIMIT 15");
                $resultTomes->execute();

                while ($row = $resultTomes->fetch(PDO::FETCH_NUM)) {
                    $resultMangaName = $conn->prepare("SELECT nom FROM manga WHERE id = " . $row[2] . " ORDER BY id DESC LIMIT 1");
                    $resultMangaName->execute();
                    $resultMangaName = $resultMangaName->fetch(PDO::FETCH_NUM);

                    echo
                    '<a href="manga.php?id=' . $row[0] . '" class="manga">
                        <img class="img-manga" src="' . $row[6] . '" alt="Manga 1">
                        <h3>Tome ' . $row[1] . ' - ' . $resultMangaName[0] . '</h3>
                        <p>Prix : ' . $row[4] . '€</p>
                    </a>';
                }
                ?>
            </div>
        </section>
        <section id="categories">
            <h2>Catégories</h2>
            <ul>
                <li><a href="#">Shonen</a></li>
                <li><a href="#">Shojo</a></li>
                <li><a href="#">Seinen</a></li>
                <li><a href="#">Josei</a></li>
                <li><a href="#">Kodomo</a></li>
            </ul>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'footer.php';
    ?>
</body>

</html>