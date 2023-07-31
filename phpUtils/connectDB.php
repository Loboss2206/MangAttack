<?php
$host = 'localhost';
$dbname = 'mangattack';
$username = 'loganpg';
$password = 'loganpgpw';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    exit;
}