<?php
session_start();
include '../../config/connexion_bd.php';

// Vérifie si l'utilisateur est un admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../../views/includes/header.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hasher le mot de passe
    $hashedPassword = md5($password);  // Si possible, utilisez password_hash à la place de md5

    // Insére le nouvel utilisateur dans la base de données
    $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashedPassword,
        ':role' => $role
    ]);

    // Redirige vers le tableau de bord admin après la création
    header("Location: ../../public/admin_dashboard.php");
    exit();
}
?>
