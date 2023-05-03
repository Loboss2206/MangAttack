<?php

function sauvegarderClient($mail, $password2, $name, $familyName, $adress, $codePostal)
{
    include('connectDB.php');

    $sql2 = 'INSERT INTO client (mail, motDePasse, nom, prenom, adresse, codePostal)
    VALUES (\'' . $mail . '\',\'' . $password2 . '\',\'' . $name . '\',\'' . $familyName . '\',\'' . $adress . '\',' . $codePostal . ')';
    $result2 = $conn->prepare($sql2);
    $result2->execute();


    $sql = 'INSERT INTO panier (mail_client) 
               VALUES (\'' . $mail . '\');';
    $result = $conn->prepare($sql);
    $result->execute();
}

function exist_userBDD($mail)
{
    include('connectDB.php');
    $result = $conn->prepare("SELECT * FROM client");
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        if ($row[0] == $mail) {
            return true;
        }
    }
    return false;
}

function user_auth($mail, $psw)
{
    include('connectDB.php');
    $result = $conn->prepare("SELECT * FROM client");
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        if ($row[0] == $mail && $row[1] == $psw) {
            return true;
        }
    }
    return false;
}

function test_email($txt)
{
    if (!filter_var($txt, FILTER_VALIDATE_EMAIL))
        return (0);
    else return (1);
}

function addToKart($idTome, $idPanier, $quantity)
{
    include('connectDB.php');
    $insertInKart = $conn->prepare("INSERT INTO panier_tome (id_tome, id_panier, quantite) VALUES ('" . $idTome . "','" . $idPanier . "','" . $quantity . "')");
    $insertInKart->execute();
}
