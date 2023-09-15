<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'phpUtils/fct.php';
include_once 'phpUtils/connectDB.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mangattack</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="quoteContainer">
        <div id="quote"></div>
        <div id="author"></div>
    </div>

    <!-- Header -->
    <?php
    include_once 'phpUtils/header.php';
    ?>

    <!-- Main -->
    <main>
        <section id="featured">
            <h2 class="title-section">Les plus vendus</h2>
            <div id="grid-featured">
                <?php
                $resultVolumes = $conn->prepare("SELECT * FROM volume ORDER BY id DESC LIMIT 12");
                $resultVolumes->execute();

                while ($row = $resultVolumes->fetch(PDO::FETCH_NUM)) {
                    $resultMangaName = $conn->prepare("SELECT name FROM manga WHERE id = " . $row[2] . " ORDER BY id DESC LIMIT 1");
                    $resultMangaName->execute();
                    $resultMangaName = $resultMangaName->fetch(PDO::FETCH_NUM);

                    echo
                    '<a href="manga.php?id=' . $row[0] . '" class="manga">
                        <img class="img-manga" src="' . $row[8] . '" alt="' . $resultMangaName[0] . ' ' . $row[1] . '">
                        <h3>Tome ' . $row[1] . ' - ' . $resultMangaName[0] . '</h3>
                        <p>Prix : ' . $row[4] . '€</p>
                    </a>';
                }
                ?>
            </div>
        </section>
        <section id="categories">
            <h2 class="title-section">Les Catégories</h2>
            <ul>
                <?php
                $resultCategories = $conn->prepare("SELECT * FROM category");
                $resultCategories->execute();
                foreach ($resultCategories as $row) {
                    echo '<li><a href="category.php?id=' . $row["id"] . '">' . $row['name'] . '</a></li>';
                }
                ?>
            </ul>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>

    <script src="js/api.js" type="module"></script>
</body>

</html>