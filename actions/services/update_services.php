<?php
session_start();
include '../../config/connexion_bd.php'; // Connexion à la base de données

if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'employee' && $_SESSION['user']['role'] !== 'admin')) {
    header("Location: ../../public/index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $serviceId = $_POST['service_id'];

        if ($action === 'update') {
            // Vérifie que les champs nom et description existent
            if (!empty($_POST['nom']) && !empty($_POST['description'])) {
                $nom = $_POST['nom'];
                $description = $_POST['description'];

                // Prépare et exécute la requête de mise à jour
                $query = $pdo->prepare("UPDATE services SET nom = :nom, description = :description WHERE id = :id");
                $query->execute([
                    'nom' => $nom,
                    'description' => $description,
                    'id' => $serviceId
                ]);

                // Redirige après la mise à jour
                header("Location: ../../public/employee_dashboard.php");
                exit();
            } else {
                echo "Nom et description sont requis pour la mise à jour.";
            }
        } elseif ($action === 'delete') {
            // Prépare et exécuter la requête de suppression
            $query = $pdo->prepare("DELETE FROM services WHERE id = :id");
            $query->execute(['id' => $serviceId]);

            // Redirige après la suppression
            header("Location: ../../public/employee_dashboard.php");
            exit();
        }
    }
}
?>
