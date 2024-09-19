<?php
session_start();
include_once "connexion_bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Recherche l'utilisateur dans la base de données
    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
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
        
        // Redirige en fonction du rôle
        if ($user['role'] === 'admin') {
            header("Location: ../public/admin_dashboard.php");
        } elseif ($user['role'] === 'employee') {
            header("Location: ../public/employee_dashboard.php");
        } else {
            header("Location: ../public/veterinarian_dashboard");
        }
        exit();
    } else {
        // Identifiants invalides
        header("Location: login.php?error=invalid_credentials");
        exit();
    }
}
?>
