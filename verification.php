<?php
session_start();

// Inclure le fichier de connexion à la base de données
include_once "connexion_bd.php";

// Vérification des identifiants
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Requête SQL pour vérifier les identifiants dans la base de données
    $sql = "SELECT * FROM Users WHERE username = ? AND password = MD5(?) AND role = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password, $role]);
    $user = $stmt->fetch();

    // Vérification des résultats de la requête
    if ($user) {
        // Stocker les informations de l'utilisateur dans la session
        $_SESSION['user'] = $user;

        // Redirection vers le tableau de bord approprié en fonction du rôle
        if ($role === 'admin') {
            header("Location: admin_dashboard.php");
            exit();
        } elseif ($role === 'employee') {
            header("Location: employee_dashboard.php");
            exit();
        } elseif ($role === 'veterinarian') {
            header("Location: veterinarian_dashboard.php");
            exit();
        }
    } else {
        // Identifiants invalides, rediriger vers la page de connexion avec un message d'erreur
        header("Location: login.php?error=invalid_credentials");
        exit();
    }
} else {
    // Redirection vers la page de connexion si la méthode de requête n'est pas POST
    header("Location: login.php");
    exit();
}
?>