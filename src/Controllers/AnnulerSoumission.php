<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Models\GetConnexion;

session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ma_base_test';

$db = new GetConnexion($host, $user, $password, $dbname);
$pdo = $db->getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['annuler_id'])) {
    $id = (int) $_POST['annuler_id'];
    
    // Supprimer la soumission de l'étudiant connecté uniquement
    $stmt = $pdo->prepare("DELETE FROM soumissions WHERE id = :id AND id_etudiant = :id_etudiant");
    $stmt->execute([
        ':id' => $id,
        ':id_etudiant' => $_SESSION['user_id']
    ]);

    $_SESSION['success'] = "Soumission annulée avec succès.";
}

header('Location: formulaire.php');
exit;
