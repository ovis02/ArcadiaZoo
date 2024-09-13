<?php
session_start();
include '../config/connexion_bd.php';

// Vérifie si l'utilisateur est un administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupére l'ID de l'utilisateur à supprimer depuis le formulaire
    $user_id = $_POST['user_id'];

    // Vérifie que l'utilisateur à supprimer n'est pas lui-même
    if ($user_id == $_SESSION['user']['id']) {
        // Ne pas permettre à l'administrateur de se supprimer lui-même
        echo "<script>alert('Vous ne pouvez pas supprimer votre propre compte.');</script>";
        header("Location: ../admin_dashboard.php");
        exit();
    }

    // Supprime l'utilisateur de la base de données
    $sqlDelete = "DELETE FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sqlDelete);
    
    if ($stmt->execute([$user_id])) {
        // Redirige après la suppression
        header("Location: ../../public/admin_dashboard.php?message=Compte supprimé avec succès");
    } else {
        echo "<script>alert('Erreur lors de la suppression du compte.');</script>";
        header("Location: ../../public/admin_dashboard.php?message=Erreur lors de la suppression du compte");
    }
}
