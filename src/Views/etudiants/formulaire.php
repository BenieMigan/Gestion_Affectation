<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement du formulaire ici
    // Exemple : move_uploaded_file(...), vérifications, etc.
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-t from-blue-50 to-blue-200 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white shadow-lg rounded-xl p-8 space-y-6">
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Renseigner ce qu'il faut</h2>

        <!-- Message succès (masqué par défaut) -->
        <div id="successMessage" class="hidden bg-green-100 text-green-800 px-4 py-3 rounded-lg text-sm text-center mb-4">
            ✅ Votre formulaire a été envoyé avec succès.
        </div>

        <form id="formulaire" action="" method="POST" enctype="multipart/form-data" class="space-y-6">

        <div>
    <label for="fiche_charge" class="block text-sm font-medium text-gray-700 mb-2">Téléversez votre fiche de charge (PDF)</label>

    <!-- Faux bouton stylisé -->
    <label for="fiche_charge" class="cursor-pointer inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
        Choisir un fichier
    </label>

    <!-- Nom du fichier sélectionné -->
    <span id="nomFichier" class="ml-3 text-sm text-gray-600">Aucun fichier choisi</span>

    <!-- Champ caché de type file -->
    <input type="file" name="fiche_charge" id="fiche_charge" accept=".pdf" required class="hidden">
</div>

            <div>
                <label for="titre_theme" class="block text-sm font-medium text-gray-700">Titre du thème</label>
                <input type="text" name="titre_theme" id="titre_theme" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
            </div>

            <div class="flex items-center mb-4">
                <input type="checkbox" id="binome" name="binome" class="mr-2">
                <label for="binome" class="text-sm font-medium text-gray-700">Est-ce un travail en binôme ?</label>
            </div>

            <div id="binome_info" class="hidden">
                <label for="nom_binome" class="block text-sm font-medium text-gray-700">Si oui, nom du binôme</label>
                <input type="text" name="nom_binome" id="nom_binome" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
            </div>

            <div class="text-center">
                <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition" id="submitBtn">Envoyer</button>
            </div>
        </form>
    </div>

    <script>
        // Affiche le champ binôme si coché
        document.getElementById('binome').addEventListener('change', function () {
            document.getElementById('binome_info').classList.toggle('hidden', !this.checked);
        });

        // Affiche le message de succès lors du clic sur "Envoyer"
        document.getElementById('formulaire').addEventListener('submit', function () {
            const successMessage = document.getElementById('successMessage');
            successMessage.classList.remove('hidden');
        });
    </script>

</body>
</html>
