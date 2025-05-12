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
    body {
      -webkit-font-smoothing: antialiased;
    }
    .nav-link {
      transition: all 0.2s ease;
    }
    .nav-link:hover {
      opacity: 0.9;
      transform: translateY(-1px);
    }
    .login-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="font-sans bg-gray-50 min-h-screen flex flex-col">

  <!-- Navigation simplifiée -->
  <nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0 flex items-center">
            <i class="fas fa-graduation-cap text-xl mr-2 text-primary-600"></i>
            <span class="text-lg font-medium text-gray-900">UnivStages</span>
          </div>
        </div>
        <div class="hidden md:flex items-center space-x-1">
          <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-900">Accueil</a>
          <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-500 hover:text-gray-900">À propos</a>
          <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-500 hover:text-gray-900">Contact</a>
          <!-- Bouton admin discret -->
          <a href="src/Views/admin/login.php" class="ml-4 px-3 py-1 text-xs text-gray-500 hover:text-primary-600" title="Accès administrateur">
            <i class="fas fa-lock"></i>
          </a>
        </div>
        <div class="-mr-2 flex items-center md:hidden">
          <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <!-- Contenu principal -->
  <main class="flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="text-center mb-16">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">
          Gestion des <span class="text-primary-600">stages universitaires</span>
        </h1>
        <p class="mt-4 max-w-xl mx-auto text-lg text-gray-600">
          Une plateforme simple et efficace pour vos stages
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
        <!-- Carte Étudiant -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 login-card">
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div class="bg-primary-100 p-2 rounded-lg">
                <i class="fas fa-user-graduate text-primary-600"></i>
              </div>
              <h3 class="ml-3 text-lg font-semibold text-gray-800">Étudiant</h3>
            </div>
            <p class="text-gray-500 text-sm mb-6">
              Gérer vos stages et suivre vos validations
            </p>
            <a href="src/Views/etudiants/login.php" class="w-full block text-center bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-md transition duration-150">
              Connexion
            </a>
          </div>
        </div>

        <!-- Carte Professeur -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 login-card">
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div class="bg-blue-100 p-2 rounded-lg">
                <i class="fas fa-chalkboard-teacher text-blue-600"></i>
              </div>
              <h3 class="ml-3 text-lg font-semibold text-gray-800">Professeur</h3>
            </div>
            <p class="text-gray-500 text-sm mb-6">
              Valider les stages et évaluer les rapports
            </p>
            <a href="src/Views/professeurs/login.php" class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150">
              Connexion
            </a>
          </div>
        </div>

        <!-- Carte Entreprise -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 login-card">
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div class="bg-green-100 p-2 rounded-lg">
                <i class="fas fa-building text-green-600"></i>
              </div>
              <h3 class="ml-3 text-lg font-semibold text-gray-800">Entreprise</h3>
            </div>
            <p class="text-gray-500 text-sm mb-6">
              Proposer des stages et suivre les stagiaires (Ne marche pas encore)
            </p>
            <a href="#" class="w-full block text-center bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-150">
              Connexion
            </a>
          </div>
        </div>
      </div>

      <!-- Section informations simplifiée -->
      <div class="mt-20 max-w-3xl mx-auto">
        <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center">Fonctionnalités</h2>
        <div class="space-y-6">
          <div class="flex items-start">
            <div class="flex-shrink-0 bg-primary-100 p-2 rounded-lg text-primary-600">
              <i class="fas fa-check"></i>
            </div>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-gray-900">Gestion simplifiée</h3>
              <p class="mt-1 text-sm text-gray-500">
                Interface intuitive pour une prise en main immédiate
              </p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="flex-shrink-0 bg-primary-100 p-2 rounded-lg text-primary-600">
              <i class="fas fa-bell"></i>
            </div>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-gray-900">Notifications</h3>
              <p class="mt-1 text-sm text-gray-500">
                Soyez alerté des importantes mises à jour
              </p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="flex-shrink-0 bg-primary-100 p-2 rounded-lg text-primary-600">
              <i class="fas fa-shield-alt"></i>
            </div>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-gray-900">Sécurité</h3>
              <p class="mt-1 text-sm text-gray-500">
                Vos données sont protégées et sécurisées
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Pied de page minimaliste -->
  <footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="md:flex md:items-center md:justify-between">
        <div class="flex justify-center md:order-2 space-x-6">
          <a href="#" class="text-gray-400 hover:text-gray-500">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-gray-500">
            <i class="fab fa-linkedin"></i>
          </a>
        </div>
        <div class="mt-8 md:mt-0 md:order-1">
          <p class="text-center text-xs text-gray-500">
            &copy; 2023 Université XYZ. Tous droits réservés.
          </p>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>