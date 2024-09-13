<?php
// Connexion à MongoDB
require 'vendor/autoload.php'; // Assurez-vous d'avoir installé MongoDB avec Composer
$mongo = new MongoDB\Client("mongodb://localhost:27017");
