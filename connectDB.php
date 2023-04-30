<?php
$host = 'localhost';
$dbname = 'mangattack';
$username = 'loboss2206';
$password = '********';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    exit;
}
