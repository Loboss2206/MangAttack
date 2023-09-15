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
    $result = $conn->prepare("SELECT * FROM user_");
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
    $result = $conn->prepare("SELECT * FROM user_");
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
    $resultCartVolumeUser = $conn->prepare("SELECT quantity FROM cart_volume WHERE id_volume = '" . $idVolume . "' AND id_cart = '" . $idCart . "'");
    $resultCartVolumeUser->execute();
    $resultCartVolumeUser = $resultCartVolumeUser->fetch(PDO::FETCH_NUM);

    if ($resultCartVolumeUser != null) {
        $quantity = $quantity + $resultCartVolumeUser[0];
        $deleteOldId = $conn->prepare("DELETE FROM cart_volume WHERE id_volume = '" . $idVolume . "' AND id_cart = '" . $idCart . "'");
        $deleteOldId->execute();
    }

    $insertInCart = $conn->prepare("INSERT INTO cart_volume (id_volume, id_cart, quantity) VALUES ('" . $idVolume . "','" . $idCart . "','" . $quantity . "')");
    $insertInCart->execute();
}

function emptyCart($idCart)
{
    include('connectDB.php');
    $resultCartVolumeUser = $conn->prepare("DELETE FROM cart_volume WHERE id_cart = " . $idCart);
    $resultCartVolumeUser->execute();
}

function createSummary($idCart)
{
    include('connectDB.php');

    $resultMailUser = $conn->prepare("SELECT mail_user FROM cart WHERE id = " . $idCart);
    $resultMailUser->execute();
    $mail_user = $resultMailUser->fetch(PDO::FETCH_NUM)[0];

    $createSummary = $conn->prepare("INSERT INTO summary (mail_user) VALUES ('" . $mail_user . "')");
    $createSummary->execute();

    $resultCart = $conn->prepare("SELECT * FROM cart_volume WHERE id_cart = " . $idCart);
    $resultCart->execute();

    $totalPrice = 0;

    while ($row = $resultCart->fetch(PDO::FETCH_NUM)) {
        $id_volume = $row[1];
        $quantity = $row[2];

        $resultVolume = $conn->prepare("SELECT * FROM volume WHERE id = " . $id_volume);
        $resultVolume->execute();
        $resultVolume = $resultVolume->fetch(PDO::FETCH_NUM);

        $resultIdSummary = $conn->prepare("SELECT id FROM summary WHERE mail_user = '" . $mail_user . "' ORDER BY id DESC LIMIT 1");
        $resultIdSummary->execute();
        $resultIdSummary = $resultIdSummary->fetch(PDO::FETCH_NUM);

        $id_summary = $resultIdSummary[0];

        $unitPrice = $resultVolume[4];
        $price = $unitPrice * $quantity;
        $totalPrice += $price;

        $insertInSummaryVolume = $conn->prepare("INSERT INTO summary_volume (id_summary, id_volume, quantity) VALUES ('" . $id_summary . "','" . $id_volume . "','" . $quantity . "')");
        $insertInSummaryVolume->execute();
    }

    $modifySummary = $conn->prepare("UPDATE summary SET total = '" . $totalPrice . "', date = '" . date("d-m-Y") . "' WHERE id = '" . $id_summary . "'");
    $modifySummary->execute();

    echo 'totalPrice : ' . $totalPrice . '<br>';
    echo 'date : ' . date("d-m-Y") . '<br>';
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

function removeVolume($idVolume, $quantity)
{
    include('connectDB.php');
    $resultVolumeQuantity = $conn->prepare("SELECT quantity FROM volume WHERE id = '" . $idVolume . "'");
    $resultVolumeQuantity->execute();
    $volumeQuantity = $resultVolumeQuantity->fetch(PDO::FETCH_NUM)[0];

    $removeVolumes = $conn->prepare("UPDATE volume SET quantity = '" . $volumeQuantity - $quantity . "' WHERE id = '" . $idVolume . "'");
    $removeVolumes->execute();
}

function removeVolumesFromCart($idCart)
{
    include('connectDB.php');
    $resultCartVolume = $conn->prepare("SELECT id_volume, quantity FROM cart_volume WHERE id_cart = '" . $idCart . "'");
    $resultCartVolume->execute();

    foreach ($resultCartVolume as $row) {
        $idVolume = $row["id_volume"];
        $quantity = $row["quantity"];
        removeVolume($idVolume, $quantity);
    }
}

function test_admin($mail)
{
    include('connectDB.php');
    $resultAdmin = $conn->prepare("SELECT admin FROM user_ WHERE mail = '" . $mail . "'");
    $resultAdmin->execute();
    $resultAdmin = $resultAdmin->fetch(PDO::FETCH_NUM)[0];

    return $resultAdmin;
}