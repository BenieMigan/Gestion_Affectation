<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gradient-to-tr from-blue-100 to-blue-300 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white shadow-xl rounded-3xl flex flex-col md:flex-row overflow-hidden max-w-4xl w-full">
        
        <!-- Illustration ou slogan -->
        <div class="md:w-1/2 bg-blue-600 text-white flex items-center justify-center p-10">
            <div class="text-center space-y-4">
                <h2 class="text-3xl font-extrabold">Bienvenue 👋</h2>
                <p class="text-lg font-light">Connecte-toi pour soumettre ta fiche de charge et suivre ton encadrement.</p>
                <img src="https://cdn-icons-png.flaticon.com/512/219/219983.png" alt="Student icon" class="w-32 mx-auto">
            </div>
        </div>

        <!-- Formulaire -->
        <div class="w-full md:w-1/2 p-8 bg-white">
            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Connexion Étudiant</h3>

            <?php if (isset($_GET['error'])): ?>
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <form action="login_action.php" method="POST" class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
                </div>

                <div class="flex justify-between text-sm text-gray-600">
                    <a href="passeoublier.php" class="text-blue-600 hover:underline">Mot de passe oublié ?</a>
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition shadow">
                    Se connecter
                </button>
            </form>

            <p class="text-center text-sm mt-6 text-gray-600">Jamais inscrit ? 
                <a href="register.php" class="text-blue-600 hover:underline">Inscris-toi ici</a>
            </p>
        </div>
       
    </div>

</body>
</html>
