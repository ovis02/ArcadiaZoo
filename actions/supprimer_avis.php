<?php
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclut le fichier de connexion à la base de données
    include_once "connexion_bd.php";

    // Récupère l'identifiant de l'avis à supprimer depuis le formulaire
    $avis_id = $_POST["avis_id"];

    // Prépare la requête SQL pour supprimer l'avis de la base de données
    $sql = "DELETE FROM Avis WHERE id = ?";

    // Prépare la requête
    $stmt = $pdo->prepare($sql);

    // Exécute la requête en liant les valeurs des paramètres
    $stmt->execute([$avis_id]);

    // Redirige l'utilisateur vers la page du tableau de bord de l'employé après avoir supprimé l'avis
    header("Location: employee_dashboard.php");
    exit();
} else {
    // Redirige l'utilisateur vers la page d'accueil si le formulaire n'a pas été soumis directement
    header("Location: index.php");
    exit();
}
?>
