<?php
include_once "../../config/connexion_bd.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    if ($action === 'valider') {
        // Valider l'avis (mettre est_valide à 1)
        $sql = "UPDATE Avis SET est_valide = 1 WHERE id = :id";
    } elseif ($action === 'supprimer') {
        // Supprimer l'avis
        $sql = "DELETE FROM Avis WHERE id = :id";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    // Redirection après l'action
    header("Location: ../../public/employee_dashboard.php");
    exit();
}
?>
