<?php
// Exemple de données récupérées depuis la base
$encadrantNom = null;
$encadrantSpecialite = null; // Laisse null si non affecté
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi Encadrant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center px-4 py-8">

    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-lg w-full">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-indigo-700">Suivi de l'Encadrant</h1>
            <p class="text-sm text-gray-500 mt-2">Consultez les informations liées à votre encadrant de stage</p>
        </div>

        <?php if ($encadrantNom && $encadrantSpecialite): ?>
            <div class="bg-green-50 border border-green-200 text-green-900 px-4 py-3 rounded-lg mb-6 text-sm flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Un encadrant vous a été affecté.
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 shadow-inner">
                <h3 class="text-lg font-semibold text-indigo-600 mb-3">Profil de l'encadrant</h3>
                <ul class="text-gray-700 space-y-2 text-sm">
                    <li><span class="font-medium">👤 Nom :</span> <?= htmlspecialchars($encadrantNom) ?></li>
                    <li><span class="font-medium">🎓 Spécialité :</span> <?= htmlspecialchars($encadrantSpecialite) ?></li>
                </ul>
            </div>
        <?php else: ?>
            <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded-lg mb-6 text-sm flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m0-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                </svg>
                Aucun encadrant ne vous a encore été affecté.
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600 mb-4">Vous pouvez envoyer une demande de relance.</p>
                <a href="demande_encadrant.php"
                   class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm font-medium py-2 px-5 rounded-lg hover:bg-indigo-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                    Envoyer une demande de relance
                </a>
            </div>
        <?php endif; ?>
        <p class="text-center text-sm mt-4">
            <a href="infoetudiant.php" class="text-blue-600 hover:underline">Retour</a>
        </p>
    </div>

</body>
</html>
