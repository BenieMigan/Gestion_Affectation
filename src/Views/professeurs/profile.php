<?php
require_once __DIR__ . '/../../Controllers/TeacherController.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Professeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex justify-between items-center bg-blue-700 px-6 py-4">
            <h1 class="text-white text-2xl font-semibold">Espace Professeur</h1>
            <a href="logout.php" class="text-sm text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded transition">Déconnexion</a>
        </div>

        <div class="p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-blue-800 mb-6 text-center">
                Bienvenue, M. <?= htmlspecialchars($prof['prenom']) ?> !
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700 mb-10">
                <div class="bg-blue-50 p-4 rounded-lg border">
                    <p class="text-sm font-medium text-gray-500">Nom</p>
                    <p class="text-lg font-semibold"><?= htmlspecialchars($prof['nom']) ?></p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg border">
                    <p class="text-sm font-medium text-gray-500">Prénom</p>
                    <p class="text-lg font-semibold"><?= htmlspecialchars($prof['prenom']) ?></p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg border">
                    <p class="text-sm font-medium text-gray-500">Email</p>
                    <p class="text-lg font-semibold"><?= htmlspecialchars($prof['email']) ?></p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg border">
                    <p class="text-sm font-medium text-gray-500">Domaine</p>
                    <p class="text-lg font-semibold"><?= htmlspecialchars($prof['domaine']) ?></p>
                </div>
            </div>

            <h3 class="text-xl font-semibold text-blue-700 mb-4">Étudiants encadrés</h3>

            <?php if (empty($etudiants)): ?>
                <p class="text-gray-600 italic">Aucun étudiant encadré pour l'instant.</p>
            <?php else: ?>
                <div class="overflow-x-auto border rounded-lg">
                    <table class="min-w-full text-sm text-gray-700">
                        <thead class="bg-blue-100 text-gray-800 font-semibold">
                            <tr>
                                <th class="py-3 px-4 text-left border-b">Nom</th>
                                <th class="py-3 px-4 text-left border-b">Prénom</th>
                                <th class="py-3 px-4 text-left border-b">Thème</th>
                                <th class="py-3 px-4 text-left border-b">Binôme</th>
                                <th class="py-3 px-4 text-left border-b">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($etudiants as $index => $etudiant): ?>
                                <tr class="<?= $index % 2 === 0 ? 'bg-white' : 'bg-blue-50' ?> hover:bg-blue-100 transition">
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($etudiant['etu_nom']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($etudiant['etu_prenom']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($etudiant['theme']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($etudiant['nomBinome'] ?: '-') ?></td>
                                    <td class="py-2 px-4 border-b capitalize"><?= htmlspecialchars($etudiant['statut']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
