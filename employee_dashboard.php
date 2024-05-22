<?php
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

// Inclure le fichier de connexion à la base de données
include_once "connexion_bd.php";

// Récupérer les avis non validés depuis la base de données
$sqlAvis = "SELECT id, pseudo, commentaire, date_creation FROM Avis WHERE est_valide = 0 ORDER BY date_creation DESC";
$stmtAvis = $pdo->query($sqlAvis);

// Récupérer les messages de contact non traités depuis la base de données
$sqlContact = "SELECT id, email, motif, description, date_creation FROM Contact ORDER BY date_creation DESC";
$stmtContact = $pdo->query($sqlContact);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Employé</title>
    <!-- Inclure vos liens CSS et scripts JavaScript ici -->
</head>
<body>
    <!-- Header avec liens de navigation, etc. -->
    <?php include 'header.php'; ?>

    <div class="container">
        <a href="logout.php">Déconnexion</a>
        <h1>Tableau de bord Employé</h1>

        <!-- Section pour gérer les avis -->
        <h2>Gérer les Avis</h2>
        <div class="avis-list">
            <?php while ($rowAvis = $stmtAvis->fetch()): ?>
                <div class="avis-item">
                    <h3><?php echo htmlspecialchars($rowAvis['pseudo']); ?></h3>
                    <p><?php echo htmlspecialchars($rowAvis['commentaire']); ?></p>
                    <p>Date de Soumission: <?php echo htmlspecialchars($rowAvis['date_creation']); ?></p>
                    <!-- Ajoutez des liens ou des formulaires pour valider ou supprimer chaque avis -->
                    <form action="valider_avis.php" method="POST">
                        <input type="hidden" name="avis_id" value="<?php echo $rowAvis['id']; ?>">
                        <button type="submit">Valider</button>
                    </form>
                    <form action="supprimer_avis.php" method="POST">
                        <input type="hidden" name="avis_id" value="<?php echo $rowAvis['id']; ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Section pour gérer les messages de contact -->
        <h2>Gérer les Messages de Contact</h2>
        <div class="contact-list">
            <?php while ($rowContact = $stmtContact->fetch()): ?>
                <div class="contact-item">
                    <h3>De: <?php echo htmlspecialchars($rowContact['email']); ?></h3>
                    <p>Motif: <?php echo htmlspecialchars($rowContact['motif']); ?></p>
                    <p>Description: <?php echo htmlspecialchars($rowContact['description']); ?></p>
                    <p>Date de Soumission: <?php echo htmlspecialchars($rowContact['date_creation']); ?></p>
                    <!-- Ajoutez des liens ou des formulaires pour valider ou supprimer chaque message de contact -->
                    <form action="valider_contact.php" method="POST">
                        <input type="hidden" name="contact_id" value="<?php echo $rowContact['id']; ?>">
                        <button type="submit">Valider</button>
                    </form>
                    <form action="supprimer_contact.php" method="POST">
                        <input type="hidden" name="contact_id" value="<?php echo $rowContact['id']; ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Footer, liens de scripts, etc. -->
    <?php include 'footer.php'; ?>
</body>
</html>
