<?php
session_start();
include '../../config/connexion_bd.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $animalId = $_POST['animal_id'];
    $etatAnimal = $_POST['etat_animal'];
    $nourritureProposee = $_POST['nourriture_proposee']; // Nouvelle donnée
    $grammageNourriture = $_POST['grammage_nourriture'];
    $datePassage = $_POST['date_passage'];

    // Préparer et exécuter la requête de mise à jour
    $query = $pdo->prepare("UPDATE animals SET etat_animal = :etat, nourriture_proposee = :nourriture, grammage_nourriture = :grammage, date_passage = :date WHERE id = :id");
    $query->execute([
        'etat' => $etatAnimal,
        'nourriture' => $nourritureProposee, // Inclure la nourriture proposée
        'grammage' => $grammageNourriture,
        'date' => $datePassage,
        'id' => $animalId
    ]);

   // Vérifie le rôle de l'utilisateur pour la redirection
    if ($_SESSION['user']['role'] === 'employee') {
        // Redirection pour l'employé
        header("Location: ../../public/employee_dashboard.php");
    } elseif ($_SESSION['user']['role'] === 'veterinarian') {
        // Redirection pour le vétérinaire
        header("Location: ../../public/veterinarian_dashboard.php");
    }

    exit();
}
?>