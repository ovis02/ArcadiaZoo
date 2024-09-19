<?php
$host = 'f80b6byii2vwv8cx.chr7pe7iynqr.eu-west-1.rds.amazonaws.com'; // Adresse du serveur de base de données
$db = 'yfnkm4lvqps5djol'; // Nom de la base de données
$user = 'wpuag6h82b11m6i7'; // Nom d'utilisateur
$pass = 'x0m4zf3b597abg9u'; // Mot de passe
$port = 3306; // Port de la base de données

// DSN (Data Source Name)
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    // Création d'une instance PDO
    $pdo = new PDO($dsn, $user, $pass);
    // Défini le mode d'erreur PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur, afficher un message et arrêter le script
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

