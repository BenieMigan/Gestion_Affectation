
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Étudiant</title>

    <!-- Tailwind + Flowbite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Créer un compte étudiant</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <form action="register_action.php" method="POST" class="space-y-5">
            <div>
                <label for="nom" class="block mb-1 text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label for="prenom" class="block mb-1 text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
    <label for="specialite" class="block text-sm font-medium text-gray-700 mb-1">Spécialité</label>
    <select name="specialite" id="specialite"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        <option value="AL">AL</option>
        <option value="SRC">SRC</option>
        <option value="SI">SI</option>
    </select>
</div>
<p class="text-xs text-gray-500">Utilisez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs spécialités.</p>


            <button type="submit" class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 transition">S'inscrire</button>
        </form>

        <p class="text-center text-sm mt-4">Déjà inscrit ? <a href="login.php" class="text-blue-600 hover:underline">Connecte-toi ici</a></p>
        </div>

</body>
</html>
