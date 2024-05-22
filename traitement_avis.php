<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclut le fichier de connexion à la base de données
    include_once "connexion_bd.php";

    // Récupère les données soumises depuis le formulaire
    $pseudo = $_POST["pseudo"];
    $email = $_POST["email"];
    $commentaire = $_POST["commentaire"];

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
    // Redirige l'utilisateur vers la page d'accueil si le formulaire n'a pas été soumis directement
    header("Location: index.php");
    exit();
}
?>
