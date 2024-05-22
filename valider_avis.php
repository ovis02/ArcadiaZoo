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

    // Récupère l'identifiant de l'avis à valider depuis le formulaire
    $avis_id = $_POST["avis_id"];

    // Prépare la requête SQL pour mettre à jour l'état de l'avis à "validé" dans la base de données
    $sql = "UPDATE Avis SET est_valide = 1 WHERE id = ?";

    // Prépare la requête
    $stmt = $pdo->prepare($sql);

    // Exécute la requête en liant les valeurs des paramètres
    $stmt->execute([$avis_id]);

    // Redirige l'utilisateur vers la page du tableau de bord de l'employé après avoir validé l'avis
    header("Location: employee_dashboard.php");
    exit();
} else {
    // Redirige l'utilisateur vers la page d'accueil si le formulaire n'a pas été soumis directement
    header("Location: index.php");
    exit();
}
?>
