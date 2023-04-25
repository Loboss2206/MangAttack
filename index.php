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
        <?php

        $host = 'localhost';
        $dbname = 'mangattack';
        $username = 'loboss2206';
        $password = 'Yoloswag06*';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit;
        }
        ?>
        <section id="featured">
            <h2>Les Nouveautés</h2>
            <div id="grid-featured">
                <?php
                $result = $conn->prepare("SELECT * FROM tome ORDER BY id DESC LIMIT 4");
                $result->execute();

                while ($row = $result->fetch(PDO::FETCH_NUM)) {
                    echo
                    '<a href="#" class="manga">
                        <img class="img-manga" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 1">
                        <h3>Tome ' . $row[2] . ' - ' . 'titre' . '</h3>
                        <p>Prix : ' . $row[3] . '€</p>
                    </a>';
                }
                ?>

                <a href="manga.php" class="manga">
                    <img class="img-manga" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 1">
                    <h3>Nom du Manga 1</h3>
                    <p>Prix : 10€</p>
                </a>

                <a href="#" class="manga">
                    <img class="img-manga" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 2">
                    <h3>Nom du Manga 2</h3>
                    <p>Prix : 15€</p>
                </a>

                <a href="#" class="manga">
                    <img class="img-manga" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 3">
                    <h3>Nom du Manga 3</h3>
                    <p>Prix : 12€</p>
                </a>

                <a href="#" class="manga">
                    <img class="img-manga" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 1">
                    <h3>Nom du Manga 1</h3>
                    <p>Prix : 10€</p>
                </a>

                <a href="#" class="manga">
                    <img class="img-manga" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 2">
                    <h3>Nom du Manga 2</h3>
                    <p>Prix : 15€</p>
                </a>

                <a href="#" class="manga">
                    <img class="img-manga" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 3">
                    <h3>Nom du Manga 3</h3>
                    <p>Prix : 12€</p>
                </a>
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