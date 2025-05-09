<?php


require_once __DIR__ . '/vendor/autoload.php';


use App\Models\Database;
use App\Models\GetConnexion;
use App\Models\dbTables\CreateAdminTable;
use App\Models\dbTables\CreateEnseignantTable;
use App\Models\dbTables\CreateEtudiantTable;

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

// Création des tables
$createAdminTable = new CreateAdminTable($connexionAvecDb);
$createAdminTable->createTable();

$createEtudiantTable = new CreateEtudiantTable($connexionAvecDb);
$createEtudiantTable->createTable();

$createEnseignantTable = new CreateEnseignantTable($connexionAvecDb);
$createEnseignantTable->createTable();

