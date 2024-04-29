<?php
include_once 'phpUtils/fct.php';
include_once 'phpUtils/connectDB.php';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['identifier'], $_POST['password'])) {
    if (!empty($_POST['identifier']) && !empty($_POST['password'])) {
        if (!test_email($_POST['identifier'])) {
            echo '<script> alert("Adresse mail non conforme"); </script>';
        } else {
            if (user_auth($_POST['identifier'], $_POST['password'])) {
                $_SESSION['identifier'] = $_POST['identifier'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['loggedin'] = 1;
                header("Location: profile.php");
                echo 'alert("Connexion Réussie")';
                exit;
            } else {
                echo '<script> alert("Identifiants incorrects"); </script>';
            }
        }
    } else {
        echo '<script> alert("Veuillez remplir tous les champs"); </script>';
    }
}

if (
    isset($_POST["numberVolume"]) && isset($_POST["mangaName"]) && isset($_POST["nameVolume"]) && isset($_POST["price"]) && isset($_POST["quantity"]) && isset($_POST["publisher"]) && isset($_POST["numberPages"]) && isset($_POST["imgURL"])
) {
    if (!empty($_POST["numberVolume"]) && !empty($_POST["mangaName"]) && !empty($_POST["nameVolume"]) && !empty($_POST["price"]) && !empty($_POST["quantity"]) && !empty($_POST["publisher"]) && !empty($_POST["numberPages"]) && !empty($_POST["imgURL"])) {
        addVolumeToBDD($_POST["numberVolume"], $_POST["mangaName"], $_POST["nameVolume"], $_POST["price"], $_POST["quantity"], $_POST["publisher"], $_POST["numberPages"], $_POST["imgURL"]);
        echo '<script> alert("Tome ajouté à la base de données"); </script>';
    } else {
        echo '<script> alert("Veuillez remplir tous les champs"); </script>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mangattack</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <!-- Header -->
    <?php
    include_once 'phpUtils/header.php';
    ?>

    <!-- Main -->
    <main>
        <section id="addToDB">
            <div id="gridAdmin">
                <form method="post">
                    <div class="form-wrap">
                        <h2>Nom du manga :</h2>
                        <select id="mangaName" name="mangaName">
                            <?php

                            $resultMangas = $conn->prepare("SELECT * FROM manga");
                            $resultMangas->execute();

                            while ($row = $resultMangas->fetch(PDO::FETCH_NUM)) {
                                echo '<option value="' . $row[1] . '">' . $row[1] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-wrap">
                        <h2>Numéro du tome :</h2>
                        <input type="number" name="numberVolume" id="numberVolume" class="input-manga">
                    </div>
                    <div class="form-wrap">
                        <h2>Nom du tome :</h2>
                        <input type="text" name="nameVolume" id="nameVolume" class="input-manga">
                    </div>
                    <div class="form-wrap">
                        <h2>URL de l'image :</h2>
                        <input type="text" name="imgURL" id="imgURL" class="input-manga">
                    </div>
                    <div class="form-wrap">
                        <h2>Prix :</h2>
                        <input type="number" step=0.01 name="price" id="price" class="input-manga">
                    </div>
                    <div class="form-wrap">
                        <h2>Quantité en stock :</h2>
                        <input type="number" name="quantity" id="quantity" class="input-manga">
                    </div>
                    <div class="form-wrap">
                        <h2>Editeur :</h2>
                        <input type="text" name="publisher" id="publisher" class="input-manga">
                    </div>
                    <div class="form-wrap">
                        <h2>Nombre de pages :</h2>
                        <input type="number" name="numberPages" id="numberPages" class="input-manga">
                    </div>

                    <input type="submit" name="submitVolume" id="submitVolume" value="Ajouter dans la base de données" />
                </form>
                <div id="divImgPreview">
                    <img src="" alt="Pas d'aperçu pour la couverture du tome" id="imgPreviewAdd">
                    <h2 id="title-picture">Image de couverture du tome</h2>
                </div>
            </div>
        </section>

        <p>Manage users</p>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script defer="defer" src="./js/admin.js"></script>
</body>

</html>