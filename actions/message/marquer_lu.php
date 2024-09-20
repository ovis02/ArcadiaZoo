<?php
session_start();
include '../../config/connexion_bd.php';

if (isset($_POST['contact_id'])) {
    $contact_id = $_POST['contact_id'];
    $sql = "UPDATE contact SET status = 'lu' WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contact_id]);
}

header("Location: ../../public/employee_dashboard.php");
exit();
?>
