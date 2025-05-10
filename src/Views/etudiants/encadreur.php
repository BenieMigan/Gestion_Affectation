<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Models\GetConnexion;

session_start();

// Assurez-vous que l'utilisateur est connecté et que l'ID de l'étudiant est disponible dans la session
if (isset($_SESSION['user_id'])) {
    try {
        // Connexion à la base de données
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dbname = 'ma_base_test';

        // Instancier la classe GetConnexion pour gérer la connexion
        $db = new GetConnexion($host, $user, $password, $dbname);
        $pdo = $db->getPDO();
        // Récupération de l'ID de l'étudiant à partir de la session
        $id_etudiant = $_SESSION['user_id'];

        // Préparation de la requête pour récupérer les soumissions de l'étudiant
        $stmt = $pdo->prepare("
            SELECT s.*, ens.nom AS encadrant_nom, ens.prenom AS encadrant_prenom
            FROM soumissions s
            LEFT JOIN enseignants ens ON s.id_enseignant = ens.id
            WHERE s.id_etudiant = :id_etudiant
        ");
        $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $stmt->execute();

        // Récupération des résultats sous forme de tableau associatif
        $soumissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }
} else {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi des Soumissions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body class="bg-gradient-to-r from-blue-200 to-indigo-300 w-full min-h-screen flex items-center justify-center px-4 py-8">

    <div class="bg-white shadow-lg rounded-xl p-10 max-w-4xl w-full">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-indigo-800 mb-2">Suivi des Soumissions</h1>
            <p class="text-lg text-gray-600">Consultez les informations relatives à vos soumissions académiques</p>
        </div>

        <!-- Affichage des soumissions -->
        <?php if (count($soumissions) > 0): ?>
           
            <table class="min-w-full table-auto border-collapse rounded-lg overflow-hidden">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Nom</th>
                        <th class="px-6 py-4 text-left">Prénom</th>
                        <th class="px-6 py-4 text-left">Spécialité</th>
                        <th class="px-6 py-4 text-left">Binôme</th>
                        <th class="px-6 py-4 text-left">Date de Soumission</th>
                        <th class="px-6 py-4 text-left">Document</th>
                        <th class="px-6 py-4 text-left">Encadrant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($soumissions as $soumission): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4"><?= htmlspecialchars($_SESSION['nom'] ?? 'Nom non renseigné') ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($_SESSION['prenom'] ?? 'Prénom non renseigné') ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($soumission['specialite'] ?? 'Spécialité non renseignée') ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($soumission['nomBinome'] ?? 'Binôme non renseigné') ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($soumission['created_at'] ?? 'Date inconnue') ?></td>
                            <td class="px-6 py-4">
                                <a href="documents/<?= htmlspecialchars($soumission['fichier_cdc'] ?? 'default_document.pdf') ?>" target="_blank" class="text-indigo-600 hover:text-indigo-800 hover:underline">
                                    Voir le document
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($soumission['encadrant_nom'] && $soumission['encadrant_prenom']): ?>
                                    <?= htmlspecialchars($soumission['encadrant_prenom']) . ' ' . htmlspecialchars($soumission['encadrant_nom']) ?>
                                <?php else: ?>
                                    <span class="text-red-500 italic">Non attribué</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded-lg mb-6">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m0-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                    </svg>
                    <span>Aucun document soumis pour l'instant.</span>
                </div>
            </div>
        <?php endif; ?>

        <p class="text-center text-sm mt-6">
            <a href="infoetudiant.php" class="w-full text-center bg-gray-500 text-white font-semibold py-3 px-5 rounded-lg hover:bg-gray-600 transition">Retour à votre profil</a>
        </p>
    </div>

</body>
</html>
