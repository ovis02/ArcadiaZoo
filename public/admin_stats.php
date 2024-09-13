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

    <!-- HEADER -->
    <header class="text-center">
        <h1>Statistiques des Animaux</h1>
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
