<?php
session_start();

$profs = include __DIR__ . '/professeurs.php';
$etudiants = include __DIR__ . '/etudiants.php';


if (!isset($_SESSION['affectations'])) {
    $_SESSION['affectations'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $etudiantEmail = $_POST['etudiant_email'];
    $profEmail = $_POST['prof_email'];
    $_SESSION['affectations'][$etudiantEmail] = $profEmail;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gestion des affectations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <h1 class="text-3xl font-bold text-center mb-8 text-blue-800">Interface Admin - Gestion des Affectations</h1>

    <div class="grid grid-cols-2 gap-10">
        <!-- Profs par spécialité -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Professeurs par spécialité</h2>
            <?php foreach ($profs as $prof): ?>
                <div class="mb-3 p-3 border rounded">
                    <p><strong><?= $prof['prenom'] ?> <?= $prof['nom'] ?></strong></p>
                    <p>Email: <?= $prof['email'] ?></p>
                    <p>Spécialité(s): <?= implode(', ', $prof['specialite']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Étudiants non affectés -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Étudiants non affectés</h2>
            <?php foreach ($etudiants as $etudiant): ?>
                <?php if (!isset($_SESSION['affectations'][$etudiant['email']])): ?>
                    <div class="mb-4 border p-3 rounded">
                        <p><strong><?= $etudiant['prenom'] ?> <?= $etudiant['nom'] ?></strong></p>
                        <form method="POST" class="mt-2 flex gap-2">
                            <input type="hidden" name="etudiant_email" value="<?= $etudiant['email'] ?>">
                            <select name="prof_email" required class="border px-2 py-1 rounded">
                                <option value="">-- Choisir un encadrant --</option>
                                <?php foreach ($profs as $prof): ?>
                                    <option value="<?= $prof['email'] ?>">
                                        <?= $prof['prenom'] . ' ' . $prof['nom'] ?> (<?= implode('/', $prof['specialite']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Affecter</button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
