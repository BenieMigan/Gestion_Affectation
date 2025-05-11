<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-gray-50 min-h-screen py-10 px-4 flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-2xl p-8 max-w-3xl w-full space-y-8">
        <!-- En-tête amélioré -->
        <div class="text-center space-y-2">
            <div class="inline-block bg-blue-100 p-3 rounded-full mb-3">
                <i class="fas fa-user-graduate text-blue-600 text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Espace Étudiant</h1>
            <p class="text-gray-500">Gestion de votre stage et suivi académique</p>
        </div>

        <!-- Grille de cartes améliorée -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Carte Soumission -->
            <a href="formulaire.php" class="card-hover bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-800 rounded-xl p-5 shadow-sm flex flex-col">
                <div class="flex items-center mb-3">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-file-upload text-blue-600"></i>
                    </div>
                    <h2 class="text-lg font-semibold">Soumettre mon travail</h2>
                </div>
                <p class="text-sm text-blue-700 flex-grow">Déposez vos documents de stage et suivez leur validation</p>
                <div class="mt-2 text-right">
                    <span class="inline-block bg-blue-200 text-blue-800 text-xs px-2 py-1 rounded-full">
                        Nouveau
                    </span>
                </div>
            </a>

            <!-- Carte Encadrement -->
            <a href="encadreur.php" class="card-hover bg-green-50 hover:bg-green-100 border border-green-200 text-green-800 rounded-xl p-5 shadow-sm flex flex-col">
                <div class="flex items-center mb-3">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-user-tie text-green-600"></i>
                    </div>
                    <h2 class="text-lg font-semibold">Encadrement</h2>
                </div>
                <p class="text-sm text-green-700 flex-grow">Consultez les informations de votre encadrant académique</p>
                <div class="mt-2 text-right">
                    <span class="inline-block bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full">
                        Pr. Martin
                    </span>
                </div>
            </a>

            <!-- Carte Relance -->
            <a href="demande_encadrant.php" class="card-hover bg-yellow-50 hover:bg-yellow-100 border border-yellow-200 text-yellow-800 rounded-xl p-5 shadow-sm flex flex-col">
                <div class="flex items-center mb-3">
                    <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-bell text-yellow-600"></i>
                    </div>
                    <h2 class="text-lg font-semibold">Demande de relance</h2>
                </div>
                <p class="text-sm text-yellow-700 flex-grow">Envoyez une demande si besoin</p>
                <div class="mt-2 text-right">
                    <span class="inline-block bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full">
                        En attente
                    </span>
                </div>
            </a>

            <!-- Carte Déconnexion -->
            <a href="logout.php" class="card-hover bg-red-50 hover:bg-red-100 border border-red-200 text-red-800 rounded-xl p-5 shadow-sm flex flex-col">
                <div class="flex items-center mb-3">
                    <div class="bg-red-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-sign-out-alt text-red-600"></i>
                    </div>
                    <h2 class="text-lg font-semibold">Déconnexion</h2>
                </div>
                <p class="text-sm text-red-700 flex-grow">Quittez votre espace sécurisé</p>
                <div class="mt-2 text-right">
                    <span class="inline-block bg-red-200 text-red-800 text-xs px-2 py-1 rounded-full">
                        Sécurisé
                    </span>
                </div>
            </a>
        </div>

        <!-- Pied de page discret -->
        <div class="text-center mt-6 pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-400">Plateforme de stages - © 2024 Université</p>
        </div>
    </div>

</body>
</html>