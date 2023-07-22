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
    <link rel="stylesheet" href="css/categories.css">
</head>

<body>
    <!-- Header -->
    <?php
    include_once 'phpUtils/header.php';
    ?>

    <!-- Main -->
    <main>
        <section id="categories">
            <?php
            $categories = $conn->prepare("SELECT * FROM category");
            $categories->execute();

            while ($row = $categories->fetch(PDO::FETCH_NUM)) {
                $resultIdMangas = $conn->prepare("SELECT id_manga FROM manga_category WHERE id_category = " . $row[0]);
                $resultIdMangas->execute();

                $rowCount = $resultIdMangas->rowCount();
                if ($rowCount > 0) {
                    echo '<h2 class="title-section">' . $row[1] . '</h2>';
                    echo '<div class="grid-categories">';
                    $left = 6;
                }

                while ($rowManga = $resultIdMangas->fetch(PDO::FETCH_NUM)) {
                    $resultVolumes = $conn->prepare("SELECT * FROM volume WHERE id_manga = " . $rowManga[0] . " ORDER BY id DESC LIMIT 6");
                    $resultVolumes->execute();

                    while ($rowVolume = $resultVolumes->fetch(PDO::FETCH_NUM)) {
                        $resultMangaName = $conn->prepare("SELECT name FROM manga WHERE id = " . $rowVolume[2] . " ORDER BY id DESC LIMIT 1");
                        $resultMangaName->execute();
                        $resultMangaName = $resultMangaName->fetch(PDO::FETCH_NUM);

                        if ($left > 0) {
                            $left--;
                            echo
                            '<div class="manga">
                        <a href="manga.php?id=' . $rowVolume[0] . '">
                            <img class="img-manga" src="' . $rowVolume[8] . '" alt="Manga 1">
                            <h3>Tome ' . $rowVolume[1] . ' - ' . $resultMangaName[0] . '</h3>
                            <p>Prix : ' . $rowVolume[4] . '€</p>
                        </a>
                    </div>';
                        }
                    }
                }

                if ($rowCount > 0) {
                    echo '</div>';
                }
            }
            ?>

        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>

    <script src="js/api.js" type="module"></script>
</body>

</html>