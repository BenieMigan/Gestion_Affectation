<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil | Plateforme de Stages</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            }
          }
        }
      }
    }
  </script>
  <style>
    .nav-link:hover {
      background: rgba(255, 255, 255, 0.1);
    }
    .active-nav {
      background: rgba(255, 255, 255, 0.2);
      border-left: 4px solid white;
    }
  </style>
</head>
<body class="font-sans bg-gray-50 min-h-screen flex flex-col">

  <!-- Navigation -->
  <nav class="bg-primary-800 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0 flex items-center">
            <i class="fas fa-graduation-cap text-2xl mr-2 text-primary-300"></i>
            <span class="text-xl font-semibold">UnivStages</span>
          </div>
          <div class="hidden md:ml-6 md:flex md:space-x-8">
            <a href="#" class="active-nav border-primary-500 text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
              <i class="fas fa-home mr-2"></i> Accueil
            </a>
            <a href="#" class="nav-link text-primary-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
              <i class="fas fa-info-circle mr-2"></i> À propos
            </a>
            <a href="#" class="nav-link text-primary-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
              <i class="fas fa-envelope mr-2"></i> Contact
            </a>
          </div>
        </div>
        <div class="hidden md:flex items-center space-x-4">
          <a href="#" class="text-primary-200 hover:text-white">
            <i class="fas fa-question-circle text-lg"></i>
          </a>
                  </div>
        <div class="-mr-2 flex items-center md:hidden">
          <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-primary-200 hover:text-white hover:bg-primary-700 focus:outline-none">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <!-- Contenu principal -->
  <main class="flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
          Plateforme de <span class="text-primary-600">Gestion des Stages</span>
        </h1>
        <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
          Connectez-vous à votre espace dédié pour gérer vos stages universitaires
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Carte Étudiant -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
          <div class="bg-primary-600 p-6 text-white">
            <div class="flex items-center">
              <div class="bg-white bg-opacity-20 p-3 rounded-full">
                <i class="fas fa-user-graduate text-2xl"></i>
              </div>
              <h3 class="ml-4 text-xl font-bold">Espace Étudiant</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 mb-6">
              Gérer vos stages, soumettre vos rapports et suivre vos validations.
            </p>
            <a href="src/Views/etudiants/login.php" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center justify-center transition duration-150">
              <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
            </a>
          </div>
        </div>

        <!-- Carte Professeur -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
          <div class="bg-blue-600 p-6 text-white">
            <div class="flex items-center">
              <div class="bg-white bg-opacity-20 p-3 rounded-full">
                <i class="fas fa-chalkboard-teacher text-2xl"></i>
              </div>
              <h3 class="ml-4 text-xl font-bold">Espace Professeur</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 mb-6">
              Valider les stages, évaluer les rapports et suivre vos étudiants.
            </p>
            <a href="src/Views/professeurs/login.php" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center justify-center transition duration-150">
              <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
            </a>
          </div>
        </div>

        <!-- Carte Administrateur -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
          <div class="bg-green-600 p-6 text-white">
            <div class="flex items-center">
              <div class="bg-white bg-opacity-20 p-3 rounded-full">
                <i class="fas fa-user-tie text-2xl"></i>
              </div>
              <h3 class="ml-4 text-xl font-bold">Espace Administrateur</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 mb-6">
              Gérer les utilisateurs, les conventions et superviser les stages.
            </p>
            <a href="src/Views/admin/login.php" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center justify-center transition duration-150">
              <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
            </a>
          </div>
        </div>
      </div>

      <!-- Section informations -->
      <div class="mt-16 bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-6">Comment ça marche ?</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex flex-col items-center text-center">
              <div class="bg-primary-100 p-4 rounded-full mb-4">
                <i class="fas fa-user-check text-primary-600 text-2xl"></i>
              </div>
              <h3 class="font-semibold text-lg mb-2">1. Connexion</h3>
              <p class="text-gray-600">Accédez à votre espace personnel avec vos identifiants universitaires</p>
            </div>
            <div class="flex flex-col items-center text-center">
              <div class="bg-blue-100 p-4 rounded-full mb-4">
                <i class="fas fa-tasks text-blue-600 text-2xl"></i>
              </div>
              <h3 class="font-semibold text-lg mb-2">2. Gestion</h3>
              <p class="text-gray-600">Gérez vos stages, documents et validations en temps réel</p>
            </div>
            <div class="flex flex-col items-center text-center">
              <div class="bg-green-100 p-4 rounded-full mb-4">
                <i class="fas fa-file-signature text-green-600 text-2xl"></i>
              </div>
              <h3 class="font-semibold text-lg mb-2">3. Validation</h3>
              <p class="text-gray-600">Suivez l'état d'avancement de vos démarches</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Pied de page -->
  <footer class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <h3 class="text-lg font-semibold mb-4">UnivStages</h3>
          <p class="text-gray-400">La plateforme officielle de gestion des stages de l'université.</p>
        </div>
        <div>
          <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Liens utiles</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white transition">FAQ</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Guide étudiant</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Règlement</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Contact</h4>
          <ul class="space-y-2">
            <li class="text-gray-400"><i class="fas fa-envelope mr-2"></i> stages@universite.fr</li>
            <li class="text-gray-400"><i class="fas fa-phone mr-2"></i> +33 1 23 45 67 89</li>
            <li class="text-gray-400"><i class="fas fa-map-marker-alt mr-2"></i> Bâtiment A, Bureau 203</li>
          </ul>
        </div>
        <div>
          <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Réseaux</h4>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter text-lg"></i></a>
            <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin text-lg"></i></a>
            <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook text-lg"></i></a>
          </div>
        </div>
      </div>
      <div class="mt-12 pt-8 border-t border-gray-700 text-center text-gray-400 text-sm">
        <p>© 2023 Université XYZ. Tous droits réservés.</p>
      </div>
    </div>
  </footer>

</body>
</html>