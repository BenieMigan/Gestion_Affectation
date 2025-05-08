<?php
session_start();

$profs = include __DIR__ . '/professeurs.php';
$etudiants = include __DIR__ . '/etudiants.php';

if (!isset($_SESSION['affectations'])) {
    $_SESSION['affectations'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $etuEmail = $_POST['etudiant_email'] ?? null;
        if ($etuEmail && isset($_SESSION['affectations'][$etuEmail])) {
            unset($_SESSION['affectations'][$etuEmail]);
        }
    } elseif (isset($_POST['etudiant_email'], $_POST['prof_email'])) {
        $etudiantEmail = $_POST['etudiant_email'];
        $profEmail = $_POST['prof_email'];
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
<body class="bg-gray-100 min-h-screen p-8">
    <h1 class="text-3xl font-bold text-center mb-8 text-blue-800">Interface Admin - Gestion des Affectations</h1>

    <div class="grid grid-cols-3 gap-6">
        <!-- Professeurs -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Professeurs par spécialité</h2>
            <?php foreach ($profs as $prof): ?>
                <div class="mb-4 p-4 border rounded-lg shadow-sm hover:bg-blue-50">
                    <p><strong class="text-blue-600"><?= $prof['prenom'] ?> <?= $prof['nom'] ?></strong></p>
                    <p class="text-sm text-gray-500">Email: <?= $prof['email'] ?></p>
                    <p class="text-sm text-gray-500">Spécialité(s): <?= implode(', ', $prof['specialite']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Étudiants non affectés -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Étudiants non affectés</h2>
            <?php foreach ($etudiants as $etudiant): ?>
                <?php if (!isset($_SESSION['affectations'][$etudiant['email']])): ?>
                    <div class="mb-4 p-4 border rounded-lg hover:bg-green-50">
                        <p><strong><?= $etudiant['prenom'] ?> <?= $etudiant['nom'] ?></strong></p>
                        <form method="POST" class="mt-2 flex flex-col gap-4">
                            <input type="hidden" name="etudiant_email" value="<?= $etudiant['email'] ?>">
                            <div>
                                <label for="prof_email" class="block text-sm font-medium text-gray-700">Choisir un encadrant</label>
                                <select name="prof_email" id="prof_email" required class="mt-1 block w-full px-4 py-2 text-sm text-gray-800 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Choisir un encadrant --</option>
                                    <?php foreach ($profs as $prof): ?>
                                        <option value="<?= $prof['email'] ?>">
                                            <?= $prof['prenom'] ?> <?= $prof['nom'] ?> (<?= implode('/', $prof['specialite']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200">Affecter</button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Étudiants affectés -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Étudiants affectés</h2>
            <?php foreach ($_SESSION['affectations'] as $etuEmail => $profEmail): ?>
                <?php
                    $etudiantFiltered = array_filter($etudiants, fn($e) => $e['email'] === $etuEmail);
                    $etudiant = reset($etudiantFiltered);
                    $profFiltered = array_filter($profs, fn($p) => $p['email'] === $profEmail);
                    $prof = reset($profFiltered);
                ?>
                <?php if ($etudiant && $prof): ?>
                    <div class="mb-4 p-4 border rounded-lg bg-green-50">
                        <p><strong class="text-green-600"><?= $etudiant['prenom'] ?> <?= $etudiant['nom'] ?></strong> → <strong class="text-green-600"><?= $prof['prenom'] ?> <?= $prof['nom'] ?></strong></p>
                        <p class="text-sm text-gray-500">Spécialité(s) encadrant : <?= implode(', ', $prof['specialite']) ?></p>
                        <form method="POST" class="mt-4">
                            <input type="hidden" name="etudiant_email" value="<?= $etudiant['email'] ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="text-red-600 hover:underline text-sm">Supprimer</button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="mb-4 p-4 border rounded-lg bg-red-100 text-red-700">
                        Données manquantes pour : <?= htmlspecialchars($etuEmail) ?> → <?= htmlspecialchars($profEmail) ?>
                        <form method="POST" class="mt-2">
                            <input type="hidden" name="etudiant_email" value="<?= htmlspecialchars($etuEmail) ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="text-red-700 underline text-sm">Supprimer l'affectation corrompue</button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
