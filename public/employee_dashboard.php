<?php
session_start();
include '../config/connexion_bd.php';

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
    header("Location: ../views/includes/header.php");
    exit();
}

$user = $_SESSION['user'];

// Récupérer les messages non lus depuis la base de données
$sqlMessages = "SELECT id, email, motif, description, date_creation, status FROM Contact ORDER BY date_creation DESC";
$stmtMessages = $pdo->query($sqlMessages);

// Récupérer les avis non validés depuis la base de données
$sqlAvis = "SELECT id, pseudo, commentaire, date_creation FROM Avis WHERE est_valide = 0 ORDER BY date_creation DESC";
$stmtAvis = $pdo->query($sqlAvis);
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
            <?php while ($rowMessage = $stmtMessages->fetch()): ?>
                <div class="message-item">
                    <p>Email : <?php echo htmlspecialchars($rowMessage['email']); ?></p>
                    <p>Motif : <?php echo htmlspecialchars($rowMessage['motif']); ?></p>
                    <p>Message : <?php echo htmlspecialchars($rowMessage['description']); ?></p>
                    <p>Date de Soumission : <?php echo htmlspecialchars($rowMessage['date_creation']); ?></p>
                    <p>Status : <?php echo htmlspecialchars($rowMessage['status']); ?></p>
                    
                    <form action="../actions/message/marquer_lu.php" method="POST" style="display: inline;">
                        <input type="hidden" name="contact_id" value="<?php echo $rowMessage['id']; ?>">
                        <button type="submit">Marquer comme lu</button>
                    </form>
                    <form action="../actions/message/supprimer_contact.php" method="POST" style="display: inline;">
                        <input type="hidden" name="contact_id" value="<?php echo $rowMessage['id']; ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </section>

        <!-- Section pour valider les avis -->
        <section class="avis-section">
            <h2>Validation des Avis</h2>
            <?php while ($rowAvis = $stmtAvis->fetch()): ?>
                <div class="avis-item">
                    <p>Avis de : <?php echo htmlspecialchars($rowAvis['pseudo']); ?></p>
                    <p>Commentaire : <?php echo htmlspecialchars($rowAvis['commentaire']); ?></p>
                    <p>Date de Soumission : <?php echo htmlspecialchars($rowAvis['date_creation']); ?></p>
                    
                    <form action="valider_avis.php" method="POST" style="display: inline;">
                        <input type="hidden" name="avis_id" value="<?php echo $rowAvis['id']; ?>">
                        <button type="submit">Valider</button>
                    </form>
                    <form action="supprimer_avis.php" method="POST" style="display: inline;">
                        <input type="hidden" name="avis_id" value="<?php echo $rowAvis['id']; ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </section>

        <!-- Section pour gérer l'alimentation des animaux -->
        <section class="animal-section">
            <h2>Gestion des Animaux</h2>
            <!-- Ici vous pouvez ajouter des informations dynamiques sur les animaux et les options pour gérer leur alimentation -->
            <article class="animal-item">
                <p>Prénom : Spog</p>
                <p>Race : Marmotte</p>
                <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
                <div class="additional-info" style="display: none;">
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
