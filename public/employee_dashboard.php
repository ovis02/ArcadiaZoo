<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
    header("Location: ../views/includes/header.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Employé</title>
    <link rel="stylesheet" href="assets/style_dashboard.css">
</head>
<body>
        <header>
        <h1>Bienvenue, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        <p>Vous êtes connecté en tant qu'<strong>Employé</strong>.</p>
        <a href="../config/logout.php" class="logout">Déconnexion</a>
    </header>

    <div class="container">
        <!-- Section pour gérer les messages des visiteurs -->
        <section class="message-section">
            <h2>Messages des Visiteurs</h2>
            <div class="message-item">
                <p>Email : visiteur@example.com</p>
                <p>Motif : Demande d'information</p>
                <p>Message : Bonjour, j'aimerais savoir les horaires d'ouverture...</p>
                <button class="mark-read">Marquer comme lu</button>
                <button class="delete">Supprimer</button>
            </div>
            <!-- D'autres messages ici -->
        </section>

        <!-- Section pour valider les avis -->
        <section class="avis-section">
            <h2>Validation des Avis</h2>
            <div class="avis-item">
                <p>Avis de : Jean Dupont</p>
                <p>Commentaire : Très beau zoo, mais manque de lions.</p>
                <button class="validate">Valider</button>
                <button class="delete">Supprimer</button>
            </div>
            <!-- D'autres avis ici -->
        </section>

        <!-- Section pour gérer l'alimentation des animaux -->
        <section class="animal-section">
            <h2>Gestion des Animaux</h2>
            <article class="animal-item">
                <p>Prénom : Spog</p>
                <p>Race : Marmotte</p>
                <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
                <div class="additional-info" style="display: none">
                    <p>Habitat : Montagnes rocheuses et prairies alpines</p>
                    <p>État de l'animal : En bonne santé</p>
                    <p>Nourriture proposée : herbes, racines, baies</p>
                    <p>Grammage : 200 à 400 grammes</p>
                    <p>Date de passage : 00/00/2024</p>
                </div>
            </article>
            <!-- D'autres animaux ici -->
        </section>
    </div>
</body>
</html>
