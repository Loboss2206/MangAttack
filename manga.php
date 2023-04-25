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
    include_once 'header.php';
    ?>

    <!-- Main -->
    <main>
        <section id="grid-presentation">
            <img id="img-presentation" src="https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0" alt="Manga 1">
            <div id="text-presentation">
                <h2>Tome 1 - One Piece</h2>
                <h3>À l'Aube d'une grande aventure</h3>
                <separator></separator>
                <p>Auteur : Eiichiro Oda</p>
                <p>Prix : 10€</p>
                <p>Catégorie : Shonen</p>
                <p>Genre : Aventure</p>
                <button>Ajouter au Panier</button>
                <button>Retirer du Panier</button>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'footer.php';
    ?>
</body>

</html>