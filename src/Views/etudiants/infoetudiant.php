<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body class="bg-gradient-to-tr from-blue-50 to-white min-h-screen py-10 px-4 flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-3xl w-full space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-blue-800 mb-2">Bienvenue sur votre Espace Étudiant</h1>
            <p class="text-gray-600">Gérez facilement vos documents, votre fiche de charge et le suivi de votre encadrant.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
            <!-- Upload fiche de charge -->
            <a href="formulaire.php" class="block bg-blue-100 hover:bg-blue-200 border border-blue-300 text-blue-800 rounded-xl p-6 shadow-sm transition">
                <h2 class="text-lg font-semibold mb-2">Soumettre mon travail</h2>
                <p class="text-sm">Consultez votre page ! </p>
            </a>

            <!-- Suivi encadrant -->
            <a href="encadreur.php" class="block bg-green-100 hover:bg-green-200 border border-green-300 text-green-800 rounded-xl p-6 shadow-sm transition">
                <h2 class="text-lg font-semibold mb-2">👨‍🏫 Encadrement</h2>
                <p class="text-sm">Plus de détails sur les éléments de votre soutenance</p>
            </a>

            <!-- Relance encadrant -->
            <a href="demande_encadrant.php" class="block bg-yellow-100 hover:bg-yellow-200 border border-yellow-300 text-yellow-800 rounded-xl p-6 shadow-sm transition">
                <h2 class="text-lg font-semibold mb-2">🔔 Relance</h2>
                <p class="text-sm">Envoyez une demande si aucun encadrant n’est encore affecté.</p>
            </a>
           <!-- Retour -->
           <a href="./acceuil.php" class="block bg-red-200 hover:bg-red-300 border border-red-300 text-red-800 rounded-xl p-6 shadow-sm transition">
                <h2 class="text-lg font-semibold mb-2">Me déconnecter</h2>
                <p class="text-sm">Quitter votre espace</p>
            </a>
            </div>

        <!--<div class="text-center mt-6">
            <a href="login.php" class="text-sm text-gray-500 hover:underline">Se déconnecter</a>
        </div>!-->
    </div>

</body>
</html>
