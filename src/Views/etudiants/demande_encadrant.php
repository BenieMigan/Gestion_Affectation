<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande de Relance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white shadow-md rounded-lg p-6 max-w-md w-full">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Demande de Relance</h2>

        <p class="text-sm text-gray-600 mb-6 text-center">
            Cette demande notifie les responsables pour l'affectation d'un encadrant à votre projet.
        </p>

        <form action="" method="POST" class="space-y-5">
            <div>
                <label for="message" class="block mb-1 text-sm font-medium text-gray-700">Message (optionnel)</label>
                <textarea name="message" id="message" rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Ex. : Je n’ai toujours pas d’encadrant attribué..."></textarea>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
                Envoyer la demande
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="infoetudiant.php" class="text-blue-600 text-sm hover:underline">← Retour à l’espace étudiant</a>
        </div>
    </div>

</body>
</html>
