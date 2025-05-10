<?php

// Charger l'autoloader pour les classes
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\AuthController;

// Créer une instance du contrôleur
$authController = new AuthController();

// Appeler la méthode logout
$authController->logout();

