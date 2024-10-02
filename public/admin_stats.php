<?php
// une requête vers le serveur Node.js pour récupérer les animaux
$response = file_get_contents('http://localhost:4000/animals');
$animals = json_decode($response, true);
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Animaux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style_dashboard.css">
</head>
<body>

 
           <header class="text-center mb-4">
        <h1>Statistiques des Animaux</h1>
        <div class="d-flex justify-content-between align-items-center">
            <!-- Lien vers l'interface administrateur -->
            <a href="admin_dashboard.php" class="btn btn-primary">Retour au Tableau de Bord Admin</a>
            <!-- Bouton de déconnexion -->
            <a href="../config/logout.php" class="logout btn btn-danger">Déconnexion</a>
        </div>
    </header>
  

    <!-- Tableau des animaux et des compteurs de "J'aime" -->
    <section class="container my-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nom de l'animal</th>
                    <th scope="col">Nombre de "J'aime"</th>
                </tr>
            </thead>
          <tbody>
    <?php foreach ($animals as $animal): ?>
    <tr>
        <!-- Colonne pour le nom de l'animal -->
        <td><?php echo htmlspecialchars($animal['animal']); ?></td>

        <!-- Colonne pour afficher le compteur de "J'aime" -->
        <td>
            <!-- Div qui sera mis à jour avec le nombre de "J'aime" -->
            <div id="result-<?php echo htmlspecialchars($animal['animal']); ?>">
                <?php echo htmlspecialchars($animal['animal']); ?>: <?php echo htmlspecialchars($animal['views']); ?>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
        </table>
    </section>

    <!-- FOOTER -->
    <footer class="text-center py-4">
        © 2024 MOHAMMAD Aowis
    </footer>
<script src="assets/script.js"></script>
</body>
</html>