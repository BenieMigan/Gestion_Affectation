<?php
    require __DIR__ . '/../../Controllers/Soumissions.php';  

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Rediriger ou afficher un message d'erreur si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}
$id_etudiant = $_SESSION['user_id'];

// Initialisation sécurisée de $error
$error = $error ?? '';  // $error sera une chaîne vide si non défini
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
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Soumission de votre sujet</h2>

        <!-- Message de succès -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg text-sm text-center mb-4">
                Votre formulaire a été envoyé avec succès.
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Message d'erreur -->
        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg text-sm text-center mb-4">
                 <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form id="formulaire" action="" method="POST" enctype="multipart/form-data" class="space-y-6">

            <!-- Upload PDF -->
            <div>
                <label for="fichier_cdc" class="block text-sm font-medium text-gray-700 mb-2">Cahier des charges (PDF)</label>
                
                <label for="fichier_cdc" class="cursor-pointer inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                    Choisir un fichier
                </label>
                
                <span id="nomFichier" class="ml-3 text-sm text-gray-600">Aucun fichier choisi</span>
                
                <input type="file" name="fichier_cdc" id="fichier_cdc" accept=".pdf" required class="hidden">
            </div>

            <!-- Thème -->
            <div>
                <label for="theme" class="block text-sm font-medium text-gray-700">Titre du thème</label>
                <input type="text" name="theme" id="theme" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
            </div>

            <!-- Binôme -->
            <div class="flex items-center mb-4">
                <input type="checkbox" id="binome" name="binome" class="mr-2">
                <label for="binome" class="text-sm font-medium text-gray-700">Travail en binôme ?</label>
            </div>

            <div id="binome_info" class="hidden">
                <label for="nomBinome" class="block text-sm font-medium text-gray-700">Nom du binôme</label>
                <input type="text" name="nomBinome" id="nomBinome" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
            </div>

            <!-- Champ caché ID Étudiant -->
            <input type="hidden" name="id_Etudiant" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">

            <!-- Bouton envoyer -->
            <div class="flex flex-col items-center gap-4 mt-6">
                <button type="submit" class="w-full bg-blue-600 text-white text-lg font-bold py-4 px-6 rounded-lg hover:bg-blue-700 transition">
                    Envoyer
                </button>

                <a href="infoEtudiant.php" class="w-full text-center bg-gray-500 text-white font-semibold py-3 px-5 rounded-lg hover:bg-gray-600 transition">
                    Retour
                </a>
            </div>

        </form>
    </div>

    <script>
        // Affiche le champ du binôme si la case est cochée
        document.getElementById('binome').addEventListener('change', function () {
            document.getElementById('binome_info').classList.toggle('hidden', !this.checked);
        });

        // Affiche le nom du fichier sélectionné
        document.getElementById('fichier_cdc').addEventListener('change', function () {
            const fileName = this.files.length > 0 ? this.files[0].name : "Aucun fichier choisi";
            document.getElementById('nomFichier').textContent = fileName;
        });
    </script>

</body>
</html>
