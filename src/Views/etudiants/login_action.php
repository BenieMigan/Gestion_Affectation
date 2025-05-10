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

// Validation du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!$email || !$password) {
        header('Location: login.php?error=Veuillez remplir tous les champs.');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: login.php?error=Email invalide.');
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header('Location: login.php?error=Aucun compte trouvé avec cet email.');
            exit;
        }

        // Vérification du mot de passe
        if (!password_verify($password, $user['password'])) {
            header('Location: login.php?error=Mot de passe incorrect.');
            exit;
        }

        // Démarrer la session et stocker les informations de l'utilisateur
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['domaine'] = $user['specialite'];

        // Redirection vers la page d'accueil ou une page protégée
        header('Location: infoEtudiant.php');
        exit;

    } catch (PDOException $e) {
        header('Location: login.php?error=Erreur interne : ' . urlencode($e->getMessage()));
        exit;
    }
}
