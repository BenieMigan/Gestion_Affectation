<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Professeur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-blue-800 mb-4">Créer un compte Professeur</h2>
        <p class="text-center text-gray-600 mb-6">Remplissez les informations ci-dessous pour vous inscrire</p>

        <form action="register_action.php" method="POST" class="space-y-4">
            <!-- Champ Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Champ Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Champ Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse Email</label>
                <input type="email" id="email" name="email" placeholder="exemple@mail.com" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Champ Domaine -->
            <div>
                <label for="domaine" class="block text-sm font-medium text-gray-700 mb-1">Domaine(s)</label>
                <select name="domaine[]" id="domaine" multiple
                    class="w-full px-4 py-2 border border-gray-300 rounded bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    <option value="AL">AL</option>
                    <option value="SI">SI</option>
                    <option value="SRC">SRC</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Utilisez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs domaines.</p>
            </div>

            <!-- Champ Mot de Passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="********" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Bouton -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
                S'inscrire
            </button>

            <!-- Lien vers la page de connexion -->
            <p class="text-center text-sm mt-2">Déjà un compte ? <a href="login.php" class="text-blue-600 hover:underline">Se connecter</a></p>
        </form>
    </div>
</body>
</html>
