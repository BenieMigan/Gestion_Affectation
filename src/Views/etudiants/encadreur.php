<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../Controllers/Soumissions.php';  

use App\Models\GetConnexion;



// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

try {
    // Connexion à la base de données
    $db = new GetConnexion('localhost', 'root', '', 'ma_base_test');
    $pdo = $db->getPDO();

    $id_etudiant = $_SESSION['user_id'];

    // Récupération des soumissions de l'étudiant
    $stmt = $pdo->prepare("
        SELECT s.*, ens.nom AS encadrant_nom, ens.prenom AS encadrant_prenom
        FROM soumissions s
        LEFT JOIN enseignants ens ON s.id_enseignant = ens.id
        WHERE s.id_etudiant = :id_etudiant
    ");
    $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
    $stmt->execute();
    $soumissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . htmlspecialchars($e->getMessage());
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi des Soumissions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        table {
            min-width: 100%;
            white-space: nowrap;
        }
        @media (max-width: 768px) {
            .responsive-table th, .responsive-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-50 to-indigo-100 min-h-screen py-8 px-4">

    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-indigo-800 mb-2">Suivi des Soumissions</h1>
                <p class="text-gray-600">Consultez l'état de vos soumissions académiques</p>
            </div>

            <?php if (count($soumissions) > 0): ?>
                <div class="table-container border border-gray-200 rounded-lg overflow-hidden">
                    <table class="w-full responsive-table">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium">Nom</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Prénom</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Spécialité</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Binôme</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Date</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Document</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Encadrant</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($soumissions as $soumission): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-700"><?= htmlspecialchars($_SESSION['nom'] ?? 'N/A') ?></td>
                                    <td class="px-6 py-4 text-gray-700"><?= htmlspecialchars($_SESSION['prenom'] ?? 'N/A') ?></td>
                                    <td class="px-6 py-4 text-gray-700"><?= htmlspecialchars($soumission['specialite'] ?? 'N/A') ?></td>
                                    <td class="px-6 py-4 text-gray-700"><?= htmlspecialchars($soumission['nomBinome'] ?? 'Aucun') ?></td>
                                    <td class="px-6 py-4 text-gray-700"><?= date('d/m/Y', strtotime($soumission['created_at'])) ?></td>
                                    <td class="px-6 py-4">
                                        <a href="documents/<?= htmlspecialchars($soumission['fichier_cdc'] ?? '#') ?>" 
                                           target="_blank" 
                                           class="text-indigo-600 hover:text-indigo-800 hover:underline flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            Voir
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if ($soumission['encadrant_nom'] && $soumission['encadrant_prenom']): ?>
                                            <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">
                                                <?= htmlspecialchars($soumission['encadrant_prenom']) . ' ' . htmlspecialchars($soumission['encadrant_nom']) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full italic">Non attribué</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
    
    </form>


                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-6 rounded-lg text-center">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-blue-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-lg font-medium mb-1">Aucune soumission trouvée</h3>
                        <p class="text-blue-600">Vous n'avez soumis aucun document pour le moment.</p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mt-8 text-center">
                <a href="infoetudiant.php" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour au profil
                </a>
            </div>
        </div>
    </div>

</body>
</html>