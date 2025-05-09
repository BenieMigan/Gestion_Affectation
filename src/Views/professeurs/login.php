<!-- Page de connexion (login.php) -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Professeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center">
    
    <div class="bg-white shadow-xl rounded-3xl flex flex-col md:flex-row overflow-hidden max-w-4xl w-full">
    <!-- Illustration ou slogan -->
        <div class="md:w-1/2 bg-blue-600 text-white flex items-center justify-center p-10">
            <div class="text-center space-y-4">
                <h2 class="text-3xl font-extrabold">Bienvenue 👋</h2>
                <p class="text-lg font-light">Connecte-toi pour soumettre ta fiche de charge et suivre ton encadrement.</p>
                <img src="https://cdn-icons-png.flaticon.com/512/219/219983.png" alt="Student icon" class="w-32 mx-auto">
            </div>
        </div>

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md space-y-6">
        <h2 class="text-3xl font-bold text-center text-blue-800">Connexion Professeur</h2>
        <form action="login_action.php" method="POST" class="space-y-5">

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse mail</label>
                <input type="email" name="email" id="email" placeholder="Entrez votre email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                Se connecter
            </button>

            <p class="text-center text-sm text-gray-600">
                Pas encore inscrit ?
                <a href="register.php" class="text-blue-600 hover:underline">Créer un compte</a>
            </p>
        </form>
    </div>
</body>
</html>
