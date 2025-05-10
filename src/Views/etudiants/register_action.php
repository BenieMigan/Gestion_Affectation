<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\GetConnexion;

session_start();

// Connexion à la base de données déjà créée
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ma_base_test';

$db = new GetConnexion($host, $user, $password, $dbname);
$pdo = $db->getPDO();

if (!$pdo) {
    die("Erreur de connexion à la base de données.");
}

// Validation de base
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom       = trim($_POST['nom']);
    $prenom    = trim($_POST['prenom']);
    $email     = trim($_POST['email']);
    $password  = $_POST['password'];
    $specialites = $_POST['specialite'] ?? [];

    if (!$nom || !$prenom || !$email || !$password || empty($specialites)) {
        header('Location: register.php?error=Veuillez remplir tous les champs.');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: register.php?error=Email invalide.');
        exit;
    }

    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!is_array($specialites)) {
            $specialites = explode(',', $specialites);
        }

        $domaine = implode(',', $specialites);

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM etudiants WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            header('Location: register.php?error=Cet email est déjà utilisé.');
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, email, password, domaine) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $hashedPassword, $domaine]);

        header('Location: login.php');
        exit;

    } catch (PDOException $e) {
        $message = $e->getCode() == 23000 ? "Cet email est déjà utilisé." : $e->getMessage();
        header("Location: register.php?error=" . urlencode($message));
        exit;
    }
}
