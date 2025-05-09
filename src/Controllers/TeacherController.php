<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\GetConnexion;

session_start();

$prof = $_SESSION['prof'] ?? null;
if (!$prof || !isset($prof['id'])) {
    header('Location: login_prof.php');
    exit;
}

// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ma_base_test';

$db = new GetConnexion($host, $user, $password, $dbname);
$pdo = $db->getPDO();

if (!$pdo) {
    die("Erreur de connexion à la base de données.");
}

// Récupération des étudiants encadrés par ce professeur
$stmt = $pdo->prepare("
    SELECT 
        e.nom AS etu_nom, 
        e.prenom AS etu_prenom,
        s.theme, 
        s.nomBinome, 
        s.statut
    FROM soumissions s
    JOIN etudiants e ON s.id_etudiant = e.id
    WHERE s.id_enseignant = ?
");
$stmt->execute([$prof['id']]);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);