<?php
// Indique que la réponse sera au format JSON
header('Content-Type: application/json');

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclut le fichier de connexion à la base de données
    include_once "../../config/connexion_bd.php";

    // Récupère et assainit les données soumises depuis le formulaire
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $motif = trim(htmlspecialchars($_POST['motif'], ENT_QUOTES, 'UTF-8'));
    $description = trim(htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8'));

    // Vérifie que les données sont valides
    if ($email && $motif && $description) {
        // Prépare la requête SQL pour insérer les données dans la base de données
        $sql = "INSERT INTO contact (email, motif, description, date_creation, status) 
                VALUES (?, ?, ?, NOW(), 'non lu')";

        // Prépare la requête
        $stmt = $pdo->prepare($sql);

        // Exécute la requête en liant les valeurs des paramètres
        $stmt->execute([$email, $motif, $description]);

        // Répond avec un message de succès
        echo json_encode(['status' => 'success', 'message' => 'Votre demande de contact a été soumise avec succès.']);
    } else {
        // Répond avec un message d'erreur en cas de données invalides
        echo json_encode(['status' => 'error', 'message' => 'Données invalides. Veuillez réessayer.']);
    }
} else {
    // Répond avec une erreur si la requête n'est pas de type POST
    echo json_encode(['status' => 'error', 'message' => 'Requête non autorisée.']);
}
?>
