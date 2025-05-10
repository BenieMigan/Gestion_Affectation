<?php
session_start();

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\GetConnexion;

// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ma_base_test';

$db = new GetConnexion($host, $user, $password, $dbname);
$pdo = $db->getPDO();

// Traitement du formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEtudiant = $_POST['id_etudiant'] ?? null;
    $idProf = $_POST['id_enseignant'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($action === 'delete' && $idEtudiant) {
        $stmt = $pdo->prepare("UPDATE soumissions SET id_enseignant = NULL WHERE id_etudiant = ?");
        $stmt->execute([$idEtudiant]);
    }elseif ($idEtudiant && $idProf) {
    $stmt = $pdo->prepare("UPDATE soumissions SET id_enseignant = ?, statut = 'acceptee' WHERE id_etudiant = ?");
    $stmt->execute([$idProf, $idEtudiant]);
    }


    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Requêtes SQL
$profs = $pdo->query("SELECT * FROM enseignants")->fetchAll(PDO::FETCH_ASSOC);

$nonAffectes = $pdo->query("
    SELECT s.*, e.nom, e.prenom 
    FROM soumissions s
    JOIN etudiants e ON s.id_etudiant = e.id
    WHERE s.id_enseignant IS NULL
")->fetchAll(PDO::FETCH_ASSOC);

$affectes = $pdo->query("
    SELECT s.*, e.nom, e.prenom, ens.nom AS prof_nom, ens.prenom AS prof_prenom 
    FROM soumissions s
    JOIN etudiants e ON s.id_etudiant = e.id
    JOIN enseignants ens ON s.id_enseignant = ens.id
    WHERE s.id_enseignant IS NOT NULL
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Affectations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .card {
            transition: all 0.2s ease;
        }
        .card:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Gestion des Affectations
            </h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">Admin</span>
                <button class="p-1 rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Enseignants</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= count($profs) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">En attente</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= count($nonAffectes) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Affectés</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= count($affectes) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des enseignants -->
        <section class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Enseignants disponibles</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($profs as $prof): ?>
                    <div class="bg-white rounded-lg shadow p-4 card">
                        <h3 class="font-medium text-gray-900"><?= htmlspecialchars($prof['prenom'] . ' ' . $prof['nom']) ?></h3>
                        <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($prof['email']) ?></p>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <?= htmlspecialchars($prof['domaine']) ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Étudiants en attente -->
        <section class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Étudiants en attente d'affectation</h2>
                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    <?= count($nonAffectes) ?> en attente
                </span>
            </div>
            
            <?php if (count($nonAffectes) > 0): ?>
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <ul class="divide-y divide-gray-200">
                        <?php foreach ($nonAffectes as $etudiant): ?>
                            <li class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="min-w-0 flex-1">
                                            <div class="text-sm font-medium text-gray-900 truncate">
                                                <?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']) ?>
                                            </div>
                                            <div class="mt-1 text-sm text-gray-500">
                                                <?= htmlspecialchars($etudiant['theme']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" class="flex items-center space-x-2">
                                        <input type="hidden" name="id_etudiant" value="<?= $etudiant['id_etudiant'] ?>">
                                        <select name="id_enseignant" required class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            <option value="">Sélectionner</option>
                                            <?php foreach ($profs as $prof): ?>
                                                <option value="<?= $prof['id'] ?>"><?= htmlspecialchars($prof['prenom'] . ' ' . $prof['nom']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Affecter
                                        </button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 text-center text-gray-500">
                    Tous les étudiants ont été affectés
                </div>
            <?php endif; ?>
        </section>

        <!-- Étudiants affectés -->
        <section>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Affectations en cours</h2>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    <?= count($affectes) ?> affectations
                </span>
            </div>
            
            <?php if (count($affectes) > 0): ?>
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <ul class="divide-y divide-gray-200">
                        <?php foreach ($affectes as $affectation): ?>
                            <li class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($affectation['prenom'] . ' ' . $affectation['nom']) ?>
                                        </div>
                                        <div class="mt-1 text-sm text-gray-500">
                                            <span class="font-medium">Encadrant :</span> <?= htmlspecialchars($affectation['prof_prenom'] . ' ' . $affectation['prof_nom']) ?>
                                        </div>
                                        <div class="mt-1 text-sm text-gray-500">
                                            <span class="font-medium">Thème :</span> <?= htmlspecialchars($affectation['theme']) ?>
                                        </div>
                                    </div>
                                    <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette affectation ?');">
                                        <input type="hidden" name="id_etudiant" value="<?= $affectation['id_etudiant'] ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Retirer
                                        </button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 text-center text-gray-500">
                    Aucune affectation enregistrée
                </div>
            <?php endif; ?>
        </section>
    </main>
</div>

</body>
</html>