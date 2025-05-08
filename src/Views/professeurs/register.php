<!-- Page d'inscription (register.php) -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Professeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Inscription Professeur</h2>
        <form action="register_action.php" method="POST" class="space-y-4">
        <input type="text" name="nom" placeholder="Nom" class="w-full px-4 py-2 border rounded" required>
            <input type="text" name="prenom" placeholder="Prénom" class="w-full px-4 py-2 border rounded" required>
            <input type="email" name="email" placeholder="Adresse mail" class="w-full px-4 py-2 border rounded" required>
            <input type="password" name="password" placeholder="Mot de passe" class="w-full px-4 py-2 border rounded" required>
            <div>
    <label for="specialite" class="block text-sm font-medium text-gray-700 mb-1">Spécialité</label>
    <select name="specialite[]" id="specialite" multiple
        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        <option value="AL">AL</option>
        <option value="SRC">SRC</option>
        <option value="SI">SI</option>
    </select>
</div>
<p class="text-xs text-gray-500">Utilisez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs spécialités.</p>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">S'inscrire</button>
            <p class="text-center text-sm">Déjà un compte ? <a href="login.php" class="text-blue-600">Se connecter</a></p>
        </form>
    </div>
</body>
</html>
