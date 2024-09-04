<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclut le fichier de connexion à la base de données
    include_once "connexion_bd.php";

    // Récupère et assainit les données soumises depuis le formulaire
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $motif = trim(htmlspecialchars($_POST['motif'], ENT_QUOTES, 'UTF-8'));
    $description = trim(htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8'));

    // Vérifie que les données sont valides
    if ($email && $motif && $description) {
        // Prépare la requête SQL pour insérer le message de contact dans la base de données
        $sql = "INSERT INTO Contact (email, motif, description) VALUES (?, ?, ?)";

        // Prépare la requête
        $stmt = $pdo->prepare($sql);

        // Exécute la requête en liant les valeurs des paramètres
        $stmt->execute([$email, $motif, $description]);

        // Redirige l'utilisateur vers la page d'accueil après avoir soumis le message de contact
        header("Location: index.php");
        exit();
    } else {
        // Redirige l'utilisateur vers la page d'accueil avec un message d'erreur
        header("Location: index.php?error=invalid_input");
        exit();
    }
} else {
    // Redirige l'utilisateur vers la page d'accueil si le formulaire n'a pas été soumis directement
    header("Location: index.php");
    exit();
}
?>
