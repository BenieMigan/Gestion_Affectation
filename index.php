<?php

require_once __DIR__ . '/vendor/autoload.php'; 
require_once __DIR__ . '/src/Views/etudiants/acceuil.php'; // Corrige le chemin d'accès

#require_once __DIR__ . '/index.php';
use App\Controllers\AuthController;
use App\Models\Database;
use App\Models\dbTables\CreateDemandeAffectation;
use App\Models\GetConnexion;
use App\Models\dbTables\CreateAdminTable;
use App\Models\dbTables\CreateEnseignantTable;
use App\Models\dbTables\CreateEtudiantTable;
use App\Models\dbTables\CreateRelanceTable;

// Paramètres de connexion
$host = 'localhost';
$user = 'root';
$password = '';

// Connexion sans base pour créer la base
$connexionSansDb = new GetConnexion($host, $user, $password);
$database = new Database($connexionSansDb);
$database->createDatabase('ma_base_test');

// Connexion à la base nouvellement créée
$connexionAvecDb = new GetConnexion($host, $user, $password, 'ma_base_test');
AuthController::init($connexionAvecDb);

// Création des tables
$createAdminTable = new CreateAdminTable($connexionAvecDb);
$createAdminTable->createTable();

$createEtudiantTable = new CreateEtudiantTable($connexionAvecDb);
$createEtudiantTable->createTable();

$createEnseignantTable = new CreateEnseignantTable($connexionAvecDb);
$createEnseignantTable->createTable();

$createDemandeAffectationTable = new CreateDemandeAffectation($connexionAvecDb);
$createDemandeAffectationTable->createTable();

$createRelanceTable = new CreateRelanceTable($connexionAvecDb);
$createRelanceTable->createTable();
