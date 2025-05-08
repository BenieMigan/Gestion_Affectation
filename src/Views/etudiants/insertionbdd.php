<?php
// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=ton_projet;charset=utf8", "root", "");

// Sécurisation des entrées
$nom        = htmlspecialchars(trim($_POST['nom']));
$prenom     = htmlspecialchars(trim($_POST['prenom']));
$email      = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
$password   = $_POST['password'];
$specialite = htmlspecialchars(trim($_POST['specialite']));

// Vérification
if (!$nom || !$prenom || !$email || !$password || !$specialite) {
    header("Location: register.php?error=Tous les champs sont requis.");
    exit;
}

// Vérifie si l'email existe déjà
$stmt = $pdo->prepare("SELECT id FROM etudiants WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    header("Location: register.php?error=Cet email est déjà utilisé.");
    exit;
}

// Hasher le mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insertion
$stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, email, password, specialite) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$nom, $prenom, $email, $hashedPassword, $specialite]);

// Redirection vers login
header("Location: login.php?message=Inscription réussie. Connecte-toi.");
exit;
?>
