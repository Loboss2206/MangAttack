<?php

function saveUser($mail, $password, $first_name, $last_name, $address, $postal_code)
{
    include('connectDB.php');

    $sql2 = 'INSERT INTO client (mail, password, last_name, first_name, address, postal_code)
    VALUES (\'' . $mail . '\',\'' . $password . '\',\'' . $first_name . '\',\'' . $last_name . '\',\'' . $address . '\',' . $postal_code . ')';
    $result2 = $conn->prepare($sql2);
    $result2->execute();


    $sql = 'INSERT INTO cart (mail_user) 
               VALUES (\'' . $mail . '\');';
    $result = $conn->prepare($sql);
    $result->execute();
}

function exist_userBDD($mail)
{
    include('connectDB.php');
    $result = $conn->prepare("SELECT * FROM user");
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
    $result = $conn->prepare("SELECT * FROM user");
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

function addToCart($idVolume, $idCart, $quantity)
{
    include('connectDB.php');
    $resultCartVolumeCustomer = $conn->prepare("SELECT quantity FROM cart_volume WHERE id_volume = '" . $idVolume . "' AND id_cart = '" . $idCart . "'");
    $resultCartVolumeCustomer->execute();
    $resultCartVolumeCustomer = $resultCartVolumeCustomer->fetch(PDO::FETCH_NUM);

    if ($resultCartVolumeCustomer != null) {
        $quantity = $quantity + $resultCartVolumeCustomer[0];
        $deleteOldId = $conn->prepare("DELETE FROM cart_volume WHERE id_volume = '" . $idVolume . "' AND id_cart = '" . $idCart . "'");
        $deleteOldId->execute();
    }

    $insertInCart = $conn->prepare("INSERT INTO cart_volume (id_volume, id_cart, quantity) VALUES ('" . $idVolume . "','" . $idCart . "','" . $quantity . "')");
    $insertInCart->execute();
}

function addVolumeToBDD($number, $nameManga, $nameVolume, $price, $quantity, $publisher, $numberPages, $img)
{
    include('connectDB.php');
    $resultManga = $conn->prepare("SELECT id FROM manga WHERE name = '" . $nameManga . "'");
    $resultManga->execute();
    $resultManga = $resultManga->fetch(PDO::FETCH_NUM)[0];

    $insert = $conn->prepare("INSERT INTO volume (number, id_manga, name, price, quantity, publisher, number_pages, img_volume) VALUES ('" . $number . "','" . $resultManga . "','" . $nameVolume . "','" . $price . "','" . $quantity . "','" . $publisher . "','" . $numberPages . "','" . $img . "');");
    $insert->execute();
}

function test_admin($mail)
{
    include('connectDB.php');
    $resultAdmin = $conn->prepare("SELECT admin FROM user WHERE mail = '" . $mail . "'");
    $resultAdmin->execute();
    $resultAdmin = $resultAdmin->fetch(PDO::FETCH_NUM)[0];

    return $resultAdmin;
}
