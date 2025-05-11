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
            <a href="/src/Views/etudiants/acceuil.php" class="active-nav border-primary-500 text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
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
