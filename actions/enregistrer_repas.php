<?php
session_start();
include_once "connexion_bd.php";

// Vérifier si l'utilisateur est connecté en tant qu'employé
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

// Valider et assainir les données du formulaire
$animal_id = filter_input(INPUT_POST, 'animal_id', FILTER_VALIDATE_INT);
$food = trim(htmlspecialchars($_POST['food'], ENT_QUOTES, 'UTF-8'));
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_FLOAT);
$date_time = trim(htmlspecialchars($_POST['date_time'], ENT_QUOTES, 'UTF-8'));

// Vérifier que les données sont valides
if ($animal_id && $food && $quantity && $date_time) {
    // Préparer et exécuter la requête d'insertion
    $sql = "INSERT INTO Repas (animal_id, nourriture, grammage, date_heure) VALUES (:animal_id, :nourriture, :grammage, :date_heure)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':animal_id' => $animal_id,
        ':nourriture' => $food,
        ':grammage' => $quantity,
        ':date_heure' => $date_time
    ]);

    // Redirection avec un message de succès
    header("Location: employee_dashboard.php?success=1");
} else {
    // Redirection avec un message d'erreur si les données sont invalides
    header("Location: employee_dashboard.php?error=1");
}
exit();
?>
