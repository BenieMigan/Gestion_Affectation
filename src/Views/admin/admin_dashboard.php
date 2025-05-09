<?php
session_start();

$profs = include __DIR__ . '/professeurs.php';
$etudiants = include __DIR__ . '/etudiants.php';

// Initialiser la session si nécessaire
if (!isset($_SESSION['affectations'])) {
    $_SESSION['affectations'] = [];
}

// Traitement des affectations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $etudiantEmail = $_POST['etudiant_email'] ?? null;
    $profEmail = $_POST['prof_email'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($action === 'delete' && $etudiantEmail) {
        unset($_SESSION['affectations'][$etudiantEmail]);
    } elseif ($etudiantEmail && $profEmail) {
        $_SESSION['affectations'][$etudiantEmail] = $profEmail;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gestion des affectations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <h1 class="text-3xl font-bold text-center text-blue-800 mb-8">Interface Admin - Gestion des Affectations</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Professeurs -->
        <section class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Professeurs</h2>
            <?php foreach ($profs as $prof): ?>
                <div class="mb-4 p-4 border rounded hover:bg-blue-50">
                    <p><strong class="text-blue-600"><?= htmlspecialchars($prof['prenom'] . ' ' . $prof['nom']) ?></strong></p>
                    <p class="text-sm text-gray-500">Email: <?= htmlspecialchars($prof['email']) ?></p>
                    <p class="text-sm text-gray-500">Spécialité(s): <?= htmlspecialchars(implode(', ', $prof['specialite'])) ?></p>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- Étudiants non affectés -->
        <section class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Étudiants non affectés</h2>
            <?php foreach ($etudiants as $etudiant): ?>
                <?php if (!isset($_SESSION['affectations'][$etudiant['email']])): ?>
                    <div class="mb-4 p-4 border rounded hover:bg-green-50">
                        <p><strong><?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']) ?></strong></p>
                        <form method="POST" class="mt-2 space-y-2">
                            <input type="hidden" name="etudiant_email" value="<?= htmlspecialchars($etudiant['email']) ?>">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Choisir un encadrant</label>
                                <select name="prof_email" required class="w-full mt-1 px-3 py-2 border rounded focus:ring focus:border-blue-500">
                                    <option value="">-- Choisir un encadrant --</option>
                                    <?php foreach ($profs as $prof): ?>
                                        <option value="<?= htmlspecialchars($prof['email']) ?>">
                                            <?= htmlspecialchars($prof['prenom'] . ' ' . $prof['nom']) ?> (<?= htmlspecialchars(implode('/', $prof['specialite'])) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Affecter</button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>

        <!-- Étudiants affectés -->
        <section class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Étudiants affectés</h2>
            <?php foreach ($_SESSION['affectations'] as $etuEmail => $profEmail): ?>
                <?php
                    $etudiant = current(array_filter($etudiants, fn($e) => $e['email'] === $etuEmail));
                    $prof = current(array_filter($profs, fn($p) => $p['email'] === $profEmail));
                ?>
                <?php if ($etudiant && $prof): ?>
                    <div class="mb-4 p-4 border rounded bg-green-50">
                        <p><strong class="text-green-600"><?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']) ?></strong>
                        → <strong class="text-green-600"><?= htmlspecialchars($prof['prenom'] . ' ' . $prof['nom']) ?></strong></p>
                        <p class="text-sm text-gray-500">Spécialité(s) encadrant : <?= htmlspecialchars(implode(', ', $prof['specialite'])) ?></p>
                        <form method="POST" class="mt-2">
                            <input type="hidden" name="etudiant_email" value="<?= htmlspecialchars($etuEmail) ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="text-red-600 text-sm hover:underline">Supprimer</button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="mb-4 p-4 border rounded bg-red-100 text-red-700">
                        Données manquantes pour : <?= htmlspecialchars($etuEmail) ?> → <?= htmlspecialchars($profEmail) ?>
                        <form method="POST" class="mt-2">
                            <input type="hidden" name="etudiant_email" value="<?= htmlspecialchars($etuEmail) ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="underline text-sm">Supprimer l'affectation corrompue</button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>
    </div>
</body>
</html>
