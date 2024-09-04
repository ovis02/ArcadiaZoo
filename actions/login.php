<?php
session_start();
include_once "connexion_bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Rechercher l'utilisateur dans la base de données
    $sql = "SELECT id, username, password, role FROM Users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Créer une session utilisateur
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ];
        
        // Redirection en fonction du rôle
        if ($user['role'] === 'admin') {
            header("Location: ../public/admin_dashboard.php");
        } elseif ($user['role'] === 'employee') {
            header("Location: ../public/employee_dashboard.php");
        } else {
            header("Location: ../public/veterinarian_dashboard.php");
        }
        exit();
    } else {
        // Identifiants invalides
        header("Location: login.php?error=invalid_credentials");
        exit();
    }
}
?>
