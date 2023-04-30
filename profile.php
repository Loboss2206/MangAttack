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
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mangattack</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <!-- Header -->
    <?php
    include_once 'phpUtils/header.php';
    ?>

    <!-- Main -->
    <main>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
            echo
            '<section id="profileSection">
            <h1>Mon Compte</h1>
            <div id="profileWrap">
                <div id="profileInfo">
                    <h2>Informations personnelles</h2>';

            $resultUser = $conn->prepare("SELECT * FROM client WHERE mail = '" . $_SESSION['identifier'] . "' AND motDePasse = '" . $_SESSION['password'] . "'");
            $resultUser->execute();
            $resultUser = $resultUser->fetch(PDO::FETCH_NUM);

            echo '
                    <p>Nom : ' . $resultUser[3] . '</p>
                    <p>Prénom : ' . $resultUser[2] . '</p>
                    <p>Adresse : ' . $resultUser[4] . '</p>
                    <p>Code Postal : ' . $resultUser[5] . '</p>
                    <p>Adresse mail : ' . $resultUser[0] . '</p>
                </div>
                <a href="kart.php">
                    <p>Votre Panier</p>
                </a>
                <a href="phpUtils/logout.php">
                    <p>Se déconnecter</p>
                </a>
            </div>
        </section>';
        } else
            echo '
        <section id="profileSection">
            <form method="post">
                <div id="form-wrap">
                    <h2>Identifiant :</h2>
                    <input type="text" placeholder="Ex : jo45hn87" name="identifier" id="identifier" class="input-profile">
                </div>
                <div id="form-wrap">
                    <h2>Mot de passe :</h2>
                    <input type="password" placeholder="******" name="password" id="password" class="input-profile">
                </div>
                <input type="submit" value="Connexion" />
                <a href="inscription.php">
                    <p>Première visite ? Inscrivez-vous !</p>
                </a>
            </form>
        </section>';
        ?>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>
</body>

</html>