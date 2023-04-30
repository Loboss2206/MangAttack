<?php
include('fct.php');
include('connectDB.php');
if (!isset($_SESSION)) {
    session_start();
    $_SESSION['loggedin'] = 1;
}


if (isset($_POST['username2']) && isset($_POST['password2'])) {
    if (!test_email($_POST['username2'])) {
?>
        <script>
            alert('Adresse mail non conforme');
        </script>
    <?php
    }
}
//authentification
if (isset($_POST['username']) && isset($_POST['password'])) {
    $result = $conn->prepare("SELECT * FROM client");
    $result->execute();
    $bool = false;
    while ($row = $result->fetch(PDO::FETCH_NUM) && $bool == false) {
        if ($row[1] == $_POST['username'] && $row[6] == $_POST['password']) {
            $bool = true;
        }
    }
    echo "bool : " . $bool;
    if ($bool) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        // chercher l'identifiant de l'utilisateur

        $_SESSION['loggedin'] = 1;
        header("Location: profile.php");
    ?>
        <script>
            alert('Connexion Réussie');
        </script>
    <?php
    } else {
    ?> <script>
            alert('username ou password incorrect');
        </script><?php
                }
            }

            // fin d'authentification

            //Affichage de la couleur du thème 

            if (isset($_POST['color'])) {
                $_SESSION['color'] = $_POST['color'];
                setcookie("color_" . $_SESSION['id'], $_POST['color']);
            }

            echo ($_SESSION['username']);
            echo ($_SESSION['password']);

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
        <div class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <form id="request" class="main_form" method="post" action="connexion.php">
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="contactus" placeholder="Email" type="type" name="username">
                                </div>
                                <div class="col-md-12">
                                    <input class="contactus" placeholder="PassWord" type="password" name="password">
                                </div>
                                <div class="col-md-12">
                                    <button class="send_btn">Connexion</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php
    include_once 'footer.php';
    ?>
</body>

</html>