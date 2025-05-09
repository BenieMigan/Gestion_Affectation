<?php
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Charger les utilisateurs
    $usersFile = __DIR__ . '/users.json';
    $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

    if (isset($users[$email]) && password_verify($password, $users[$email])) {
        $_SESSION['prof'] = $email;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $errors[] = "Email ou mot de passe incorrect.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-blue-800 mb-4">Connexion Administrateur</h2>

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

            <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Se connecter</button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">Pas encore de compte ? <a href="register.php" class="text-blue-600 hover:underline">S'inscrire</a></p>
    </div>

</body>
</html>
