<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil | Plateforme de Stages</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
          colors: {
            primary: '#2563eb',
            secondary: '#1e40af',
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-50 min-h-screen flex items-center justify-center font-sans">

  <div class="flex w-full max-w-6xl shadow-xl rounded-3xl overflow-hidden bg-white">
    
    <!-- Illustration à gauche -->
    <div class="w-1/2 bg-blue-600 text-white flex flex-col items-center justify-center p-10">
      <h2 class="text-4xl font-bold mb-4">Bienvenue 🎓</h2>
      <p class="text-lg mb-6 text-center">Accédez à votre espace selon votre rôle et gérez facilement les stages universitaires.</p>
      <img src="https://cdn-icons-png.flaticon.com/512/201/201623.png" alt="Illustration étudiant" class="w-2/3 max-w-xs">
    </div>

    <!-- Bloc de connexion à droite -->
    <div class="w-1/2 p-10 flex flex-col justify-center">
      <h3 class="text-2xl font-bold text-gray-800 mb-6">Choisissez votre espace</h3>

      <div class="space-y-4">
        <a href="login.php" class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-3 rounded-xl text-lg font-medium transition duration-300">
          👨‍🎓 Espace Étudiant
        </a>
        <a href="src/Views/admin/login.php" class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-3 rounded-xl text-lg font-medium transition duration-300">
          🧑‍💼 Espace Responsable
        </a>
        <a href="src/Views/professeurs/login.php" class="block w-full bg-yellow-400 hover:bg-yellow-500 text-white text-center py-3 rounded-xl text-lg font-medium transition duration-300">
          👨‍🏫 Espace Professeur
        </a>
      </div>

      <p class="mt-8 text-sm text-gray-400 text-center">
        © <?= date('Y') ?> Université XYZ. Tous droits réservés.
      </p>
    </div>

  </div>

</body>
</html>
