<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\GetConnexion;

session_start();

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

// Validation du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Vérification des champs requis
    if (!$email || !$password) {
        header('Location: login_prof.php?error=Veuillez remplir tous les champs.');
        exit;
    }

    // Vérification de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: login_prof.php?error=Email invalide.');
        exit;
    }

    try {
        // Récupération des données du professeur
        $stmt = $pdo->prepare("SELECT * FROM enseignants WHERE email = ?");
        $stmt->execute([$email]);
        $prof = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$prof) {
            header('Location: login_prof.php?error=Aucun compte trouvé avec cet email.');
            exit;
        }

        // Vérification du mot de passe
        if (!password_verify($password, $prof['password'])) {
            header('Location: login_prof.php?error=Mot de passe incorrect.');
            exit;
        }

        // Stockage des infos dans la session sous une seule variable
        $_SESSION['prof'] = $prof;

        // Redirection vers le profil
        header('Location: profile.php');
        exit;

    } catch (PDOException $e) {
        error_log($e->getMessage());
        header('Location: login_prof.php?error=Erreur interne.');
        exit;
    }
}
?>
