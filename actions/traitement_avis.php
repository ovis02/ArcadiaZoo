<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclut le fichier de connexion à la base de données
    include_once "connexion_bd.php";

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

        // Redirige l'utilisateur vers la page d'accueil après avoir soumis l'avis
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
