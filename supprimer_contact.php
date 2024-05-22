<?php
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de connexion à la base de données
    include_once "connexion_bd.php";

    // Récupère l'ID du message de contact à supprimer
    $contact_id = $_POST["contact_id"];

    // Prépare la requête SQL pour supprimer le message de contact de la base de données
    $sql = "DELETE FROM Contact WHERE id = ?";

    // Prépare la requête
    $stmt = $pdo->prepare($sql);

    // Exécute la requête en liant les valeurs des paramètres
    $stmt->execute([$contact_id]);

    // Redirige l'utilisateur vers la page du tableau de bord de l'employé après avoir supprimé le message de contact
    header("Location: employee_dashboard.php");
    exit();
} else {
    // Redirige l'utilisateur vers la page d'accueil si le formulaire n'a pas été soumis directement
    header("Location: index.php");
    exit();
}
?>
