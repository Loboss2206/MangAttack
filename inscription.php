<?php
include_once 'phpUtils/fct.php';
include_once 'phpUtils/connectDB.php';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['firstName'], $_POST['lastName'], $_POST['mail'], $_POST['password2'], $_POST['address'], $_POST['postalCode'])) {
    if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['mail']) && !empty($_POST['password2']) && !empty($_POST['address']) && !empty($_POST['postalCode'])) {
        if (test_email($_POST['mail'])) {
            if (!exist_userBDD($_POST['mail'])) {
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['mail'];
                $password2 = $_POST['password2'];
                $address = $_POST['address'];
                $postalCode = $_POST['postalCode'];

                saveUser($email, $password2, $firstName, $lastName, $address, $postalCode);

                $_SESSION['identifier'] = $email;
                $_SESSION['password'] = $password2;
                $_SESSION['loggedin'] = 1;

                echo '<script> alert("Inscription réussie"); </script>';
                header("Location: profile.php");
                exit;
            } else {
                echo '<script> alert("Adresse mail déjà utilisée"); </script>';
            }
        } else {
            echo '<script> alert("Adresse mail non conforme"); </script>';
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
        <section id="profileSection">
            <form method="post">
                <div id="form-wrap">
                    <h2>Nom :</h2>
                    <input type="text" placeholder="Ex : Bouillon" name="lastName" id="lastName" class="input-profile">
                </div>
                <div id="form-wrap">
                    <h2>Prénom :</h2>
                    <input type="text" placeholder="Ex : Philippe" name="firstName" id="firstName" class="input-profile">
                </div>
                <div id="form-wrap">
                    <h2>Email :</h2>
                    <input type="text" placeholder="Ex : philou225@gmail.com" name="mail" id="mail" class="input-profile">
                </div>
                <div id="form-wrap">
                    <h2>Mot de passe :</h2>
                    <input type="password" placeholder="******" name="password2" id="password2" class="input-profile">
                </div>
                <div id="form-wrap">
                    <h2>Adresse :</h2>
                    <input type="text" placeholder="Ex : 90 rue de la paix" name="address" id="address" class="input-profile">
                </div>
                <div id="form-wrap">
                    <h2>Code Postal :</h2>
                    <input type="number" placeholder="Ex : 95000" name="postalCode" id="postalCode" class="input-profile">
                </div>
                <input type="submit" value="Inscription" />
            </form>
        </section>
    </main>

    <!-- Footer -->
    <?php
    include_once 'phpUtils/footer.php';
    ?>
</body>

</html>