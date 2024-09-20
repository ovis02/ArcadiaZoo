<?php
include '../../config/connexion_bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $motif = $_POST['motif'];
    $description = $_POST['description'];

    $sql = "INSERT INTO contact (email, motif, description, date_creation, status) 
            VALUES (?, ?, ?, NOW(), 'non lu')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $motif, $description]);

    header("Location: confirmation.php?message=success");
    exit();
}
?>
