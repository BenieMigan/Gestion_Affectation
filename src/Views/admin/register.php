<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\GetConnexion;

session_start();
$errors = [];

// Connexion avec GetConnexion
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ma_base_test';

$db = new GetConnexion($host, $user, $password, $dbname);
$pdo = $db->getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email invalide.";
    }

    if ($password !== $confirm) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $errors[] = "Cet email est déjà utilisé.";
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO admins (email, password, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$email, $hashedPassword]);

        header('Location: login.php');
        exit;
    }
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-blue-800 mb-4">Inscription Administrateur</h2>

        <?php if (isset($error)): ?>
            <div class="mb-4 text-red-600 text-sm">
                <p><?= $error ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="password" name="password" required class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" required class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">S'inscrire</button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">Déjà inscrit ? <a href="login.php" class="text-blue-600 hover:underline">Se connecter</a></p>
    </div>

</body>
</html>
