<?php
require 'vendor/autoload.php'; // si vous avez utilisé Composer

use MongoDB\Client;

$mongoClient = new Client("mongodb://localhost:27017");
$database = $mongoClient->ArcadiaZoo;
$collection = $database->animal_views;
?>
