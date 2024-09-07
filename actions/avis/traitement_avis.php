<?php
// Indiquer que la réponse sera au format JSON
header('Content-Type: application/json');

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclut le fichier de connexion à la base de données
    include_once "../../config/connexion_bd.php";

    // Récupère et assainit les données soumises depuis le formulaire
    $pseudo = trim(htmlspecialchars($_POST['pseudo'], ENT_QUOTES, 'UTF-8'));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $commentaire = trim(htmlspecialchars($_POST['commentaire'], ENT_QUOTES, 'UTF-8'));

    // Vérifie que les données sont valides
    if ($pseudo && $email && $commentaire) {
        // Prépare la requête SQL pour insérer l'avis dans la base de données
        $sql = "INSERT INTO Avis (pseudo, email, commentaire) VALUES (?, ?, ?)";

        // Prépare la requête
        $stmt = $pdo->prepare($sql);

        // Exécute la requête en liant les valeurs des paramètres
        $stmt->execute([$pseudo, $email, $commentaire]);

        // Répondre avec un message de succès
        echo json_encode(['status' => 'success', 'message' => 'Votre avis a été soumis avec succès.']);
    } else {
        // Répondre avec un message d'erreur
        echo json_encode(['status' => 'error', 'message' => 'Données invalides. Veuillez réessayer.']);
    }
} else {
    // Répondre avec une erreur si la requête n'est pas de type POST
    echo json_encode(['status' => 'error', 'message' => 'Requête non autorisée.']);
}
?>
