<?php
session_start();
include '../config/connexion_bd.php';

// Vérifie si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/includes/header.php");
    exit();
}

$user = $_SESSION['user'];

// Récupére les services depuis la base de données
$sqlServices = "SELECT id, nom, description FROM services";
$stmtServices = $pdo->query($sqlServices);

// Récupére les comptes utilisateurs
$sqlUsers = "SELECT id, username, role FROM users";
$stmtUsers = $pdo->query($sqlUsers);


//filtre animaux

// Initialisation des filtres
$animalFilter = isset($_GET['animal']) ? $_GET['animal'] : '';
$dateFilter = isset($_GET['date']) ? $_GET['date'] : '';

// Construire la requête SQL avec des filtres conditionnels
$sql = "SELECT * FROM animals WHERE 1=1"; // La clause WHERE 1=1 permet d'ajouter des conditions dynamiquement

if ($animalFilter) {
    $sql .= " AND prenom = :animal";
}
if ($dateFilter) {
    $sql .= " AND date_passage = :date";
}

$query = $pdo->prepare($sql);

if ($animalFilter) {
    $query->bindParam(':animal', $animalFilter);
}
if ($dateFilter) {
    $query->bindParam(':date', $dateFilter);
}

$query->execute();
$animals = $query->fetchAll(PDO::FETCH_ASSOC);
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style_dashboard.css">
</head>
<body>
    <header class="bg-light py-3 text-center">
        <h1>Bienvenue, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        <p>Vous êtes connecté en tant qu'<strong>Administrateur</strong>.</p>
        <a href="../config/logout.php" class="logout btn btn-danger">Déconnexion</a>
    </header>

    <div class="container my-4">
        <!-- Section pour gérer les comptes utilisateurs -->
        <section class="user-section mb-5">
    <h2 class="text-center">Gestion des Comptes Utilisateurs</h2>
    
    <!-- Formulaire pour créer un nouvel utilisateur -->
    <div class="col-lg-6 mx-auto">
        <h3 class="text-center">Créer un nouvel utilisateur</h3>
        <form action="../actions/users/create_user.php" method="POST" class="p-3 bg-light rounded shadow">
  <div class="mb-3">
            <label for="username" class="form-label">Email (Nom d'utilisateur)</label>
            <!-- id type email -->
            <input type="email" class="form-control" id="username" name="username" required>
        </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="employee">Employé</option>
                    <option value="veterinarian">Vétérinaire</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Créer l'utilisateur</button>
        </form>
    </div>

<div class="row mt-5">
    <?php while ($userRow = $stmtUsers->fetch()): ?>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="user-item p-3 rounded shadow">
                <p><strong>Nom d'utilisateur:</strong> <?php echo htmlspecialchars($userRow['username']); ?></p>
                <p><strong>Rôle:</strong> <?php echo htmlspecialchars($userRow['role']); ?></p>

                <?php if ($userRow['role'] !== 'admin'): ?>
                    <!-- Formulaire pour supprimer l'utilisateur, sauf s'il est administrateur -->
                    <form action="../actions/users/delete_user.php" method="POST" class="d-inline">
                        <input type="hidden" name="user_id" value="<?php echo $userRow['id']; ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <?php endwhile; ?>
    </div>
</section>

        <!-- Section pour gérer les services -->
        <section class="service-section mt-5">
            <h2 class="text-center mb-4">Gestion des Services</h2>
            <div class="container">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Nom du Service</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($service = $stmtServices->fetch()): ?>
                            <tr>
                                <td>
                                    <!-- Champ pour modifier le nom du service -->
                                    <form action="../actions/services/update_services.php" method="post" class="d-inline">
                                        <input type="text" name="nom" value="<?php echo htmlspecialchars($service['nom']); ?>" required>
                                </td>
                                <td>
                                    <!-- Champ pour modifier la description du service -->
                                    <input type="text" name="description" value="<?php echo htmlspecialchars($service['description']); ?>" required>
                                </td>
                                <td>
                                    <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                                    <input type="hidden" name="action" value="update"> <!-- Action pour la mise à jour -->
                                    <button type="submit" class="btn btn-warning">Modifier</button>
                                    </form>

                                    <!-- Formulaire pour supprimer le service -->
                                    <form action="../actions/services/update_services.php" method="post" class="d-inline">
                                        <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                                        <input type="hidden" name="action" value="delete"> <!-- Action pour la suppression -->
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
<div class="container mt-4">
    <h2 class="text-center mb-4">Comptes Rendus Vétérinaires</h2>

    <!-- Formulaire de filtre -->
    <form method="GET" action="" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="animal" class="form-label">Filtrer par animal</label>
                <select id="animal" name="animal" class="form-select">
                    <option value="">Tous les animaux</option>
                    <?php
                    // Récupérer la liste unique des prénoms des animaux pour le filtre
                    $animalListQuery = $pdo->query("SELECT DISTINCT prenom FROM animals");
                    while ($animalRow = $animalListQuery->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($animalRow['prenom'] === $animalFilter) ? 'selected' : '';
                        echo "<option value=\"" . htmlspecialchars($animalRow['prenom']) . "\" $selected>" . htmlspecialchars($animalRow['prenom']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label">Filtrer par date</label>
                <input type="date" id="date" name="date" class="form-control" value="<?php echo htmlspecialchars($dateFilter); ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Appliquer les filtres</button>
    </form>

    <!-- Tableau des comptes rendus vétérinaires avec options de modification et suppression -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Prénom</th>
                    <th>Race</th>
                    <th>État</th>
                    <th>Nourriture proposée</th>
                    <th>Grammage</th>
                    <th>Date de Passage</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($animals): ?>
                    <?php foreach ($animals as $animal) { ?>
                        <tr>
                            <!-- Affichage des informations actuelles de l'animal -->
                            <td><?php echo htmlspecialchars($animal['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($animal['race']); ?></td>

                            <!-- Formulaire de modification pour l'état -->
                            <td>
                                <form action="../actions/animals/update_animal.php" method="post">
                                    <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                                    <input type="text" name="etat_animal" value="<?php echo htmlspecialchars($animal['etat_animal']); ?>" class="form-control" required>
                            </td>

                            <!-- Formulaire de modification pour la nourriture proposée -->
                            <td>
                                    <input type="text" name="nourriture_proposee" value="<?php echo htmlspecialchars($animal['nourriture_proposee']); ?>" class="form-control" required>
                            </td>

                            <!-- Formulaire de modification pour le grammage -->
                            <td>
                                    <input type="number" name="grammage_nourriture" value="<?php echo htmlspecialchars($animal['grammage_nourriture']); ?>" class="form-control" required>
                            </td>

                            <!-- Formulaire de modification pour la date de passage -->
                            <td>
                                    <input type="datetime-local" name="date_passage" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($animal['date_passage']))); ?>" class="form-control" required>
                            </td>

                            <!-- Actions de modification et suppression -->
                            <td>
                                    <!-- Bouton de modification -->
                                    <button type="submit" class="btn btn-success">Modifier</button>
                                </form>

                                <!-- Formulaire de suppression -->
                                <form action="../actions/animals/delete_animal.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cet animal ?');">
                                    <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucun compte rendu trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
  <!-- SECTION: Lien vers les Statistiques Admin -->
    <div class="container text-center my-5">
        <h2 class="text-center mb-4">Statistiques Admin</h2>
        <a href="admin_stats.php" class="futuristic-link">Voir les Statistiques</a>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
