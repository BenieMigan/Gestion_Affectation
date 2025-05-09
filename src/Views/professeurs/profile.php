<?php
session_start();

$prof = $_SESSION['prof'] ?? null;
if (!$prof) {
    header('Location: register.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Professeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 text-center">Bienvenue, Mr/Mme <?= htmlspecialchars($prof['prenom']) ?> !</h2>
        <div class="space-y-3 text-gray-700">
            <p><strong>Nom :</strong> <?= htmlspecialchars($prof['nom']) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($prof['prenom']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($prof['email']) ?></p>
            <p><strong>Spécialité(s) :</strong></p>
<ul class="list-disc list-inside text-gray-600">
    <?php foreach ($prof['specialite'] as $spec): ?>
        <li><?= htmlspecialchars($spec) ?></li>
    <?php endforeach; ?>
</ul>

        </div>
    </div>
</body>
</html>
