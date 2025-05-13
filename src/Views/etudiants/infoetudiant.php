<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar-item {
            transition: all 0.2s ease;
        }
        .sidebar-item:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }
        .sidebar-item.active {
            background-color: rgba(59, 130, 246, 0.2);
            border-left: 3px solid #3b82f6;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">

    <!-- Sidebar -->
    <div class="sidebar bg-white w-64 min-h-screen shadow-md fixed">
        <div class="p-5 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <i class="fas fa-graduation-cap text-blue-600"></i>
                </div>
                <span class="font-semibold text-gray-800">UnivStages</span>
            </div>
        </div>

        <div class="p-4">
            <div class="mb-6">
                <div class="flex items-center space-x-3 mb-4 px-3 py-2 bg-blue-50 rounded-lg">
                    <div class="bg-blue-100 p-2 rounded-full">
                        <i class="fas fa-user-graduate text-blue-600 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">Jean Dupont</p>
                        <p class="text-xs text-gray-500">Master Informatique</p>
                    </div>
                </div>
            </div>

            <nav class="space-y-1 text-sm">
                <!-- Tableau de bord -->
                <a href="#" class="sidebar-item flex items-center space-x-3 px-3 py-2 rounded-lg text-blue-700 bg-blue-100 font-semibold">
                    <i class="fas fa-home text-blue-600 w-5"></i>
                    <span>Tableau de bord</span>
                </a>

                <!-- Soumission -->
                <a href="formulaire.php" class="sidebar-item flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                    <i class="fas fa-file-upload text-gray-500 w-5"></i>
                    <span>Soumission</span>
                    <span class="ml-auto bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded-full">Nouveau</span>
                </a>

                <!-- Encadrement -->
                <a href="encadreur.php" class="sidebar-item flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                    <i class="fas fa-user-tie text-gray-500 w-5"></i>
                    <span>Encadrement</span>
                </a>

                <!-- Demandes -->
                <a href="demande_encadrant.php" class="sidebar-item flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                    <i class="fas fa-bell text-gray-500 w-5"></i>
                    <span>Demandes</span>
                    <span class="ml-auto bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded-full">2</span>
                </a>

                <!-- Documents -->
                <a href="documents.php" class="sidebar-item flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                    <i class="fas fa-folder text-gray-500 w-5"></i>
                    <span>Documents</span>
                </a>

                <!-- Calendrier -->
                <a href="calendrier.php" class="sidebar-item flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                    <i class="fas fa-calendar-alt text-gray-500 w-5"></i>
                    <span>Calendrier</span>
                </a>

                <!-- Déconnexion -->
                <div class="border-t pt-3 mt-3 border-gray-200">
                    <form action="logout.php" method="POST">
                    <button type="submit" class="w-full text-left flex items-center space-x-3 px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Déconnexion</span>
                    </button>
                    </form>
                </div>
            </nav>

        </div>
     

        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100">
            <a href="logout.php" class="sidebar-item flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700">
                <i class="fas fa-sign-out-alt text-gray-500 w-5"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="flex-1 ml-64 p-8">
        <div class="max-w-4xl mx-auto">
            <!-- En-tête -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
                    <p class="text-gray-500">Bienvenue dans votre espace étudiant</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-500"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-user text-blue-600 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Cartes principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Carte Soumission -->
                <div class="card-hover bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-file-upload text-blue-600"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Soumission de documents</h2>
                            <p class="text-sm text-gray-500">Dernier dépôt: 15/04/2024</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Déposez vos documents de stage et suivez leur validation par vos encadrants.</p>
                    <a href="formulaire.php" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Accéder au formulaire <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <!-- Carte Encadrement -->
                <div class="card-hover bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-user-tie text-green-600"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Votre encadrant</h2>
                            <p class="text-sm text-gray-500">Pr. Sophie Martin</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Consultez les informations et les disponibilités de votre encadrant académique.</p>
                    <a href="encadreur.php" class="inline-flex items-center text-green-600 hover:text-green-800 text-sm font-medium">
                        Voir le profil <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Section Documents récents -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Documents récents</h2>
                    <a href="documents.php" class="text-sm text-blue-600 hover:text-blue-800">Voir tout</a>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-file-pdf text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Rapport de stage.pdf</p>
                                <p class="text-xs text-gray-500">Déposé le 10/04/2024</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Validé</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-file-word text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Convention.doc</p>
                                <p class="text-xs text-gray-500">Déposé le 05/04/2024</p>
                            </div>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">En revue</span>
                    </div>
                </div>
            </div>

            <!-- Section Prochaines échéances -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Prochaines échéances</h2>
                    <a href="calendrier.php" class="text-sm text-blue-600 hover:text-blue-800">Voir le calendrier</a>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg">
                        <div class="bg-red-100 p-2 rounded-lg mr-3 mt-1">
                            <i class="fas fa-calendar-check text-red-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Soutenance finale</p>
                            <p class="text-xs text-gray-500">15 juin 2024 - 14:00</p>
                        </div>
                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Important</span>
                    </div>
                    
                    <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg">
                        <div class="bg-purple-100 p-2 rounded-lg mr-3 mt-1">
                            <i class="fas fa-clock text-purple-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Rendu du rapport final</p>
                            <p class="text-xs text-gray-500">1 juin 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>