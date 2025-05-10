<?php
// Démarrage de la session
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Models\GetConnexion;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ma_base_test';

// Instancier la classe GetConnexion pour gérer la connexion
$db = new GetConnexion($host, $user, $password, $dbname);
$pdo = $db->getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupérer les données du formulaire
        $theme = trim($_POST['theme']);
        $nomBinome = !empty($_POST['nomBinome']) ? trim($_POST['nomBinome']) : null;
        $id_etudiant = $_SESSION['user_id'];

        // On peut ne pas avoir d'enseignant attribué au départ
        $id_enseignant = null;

        // Vérifier et gérer le fichier PDF
        if (!isset($_FILES['fichier_cdc']) || $_FILES['fichier_cdc']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Le fichier est obligatoire.");
        }

        $file = $_FILES['fichier_cdc'];
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (strtolower($extension) !== 'pdf') {
            throw new Exception("Seuls les fichiers PDF sont autorisés.");
        }

        // Vérification de la taille du fichier (ex : 5 Mo max)
        $maxSize = 5 * 1024 * 1024; // 5 Mo
        if ($file['size'] > $maxSize) {
            throw new Exception("Le fichier est trop volumineux. La taille maximale est de 5 Mo.");
        }

        // Chemin de destination
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid('cdc_', true) . '.pdf';
        $filePath = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            throw new Exception("Erreur lors de l'enregistrement du fichier.");
        }

        // Insertion dans la BDD
        $stmt = $pdo->prepare("
            INSERT INTO soumissions (id_etudiant, id_enseignant, nomBinome, theme, fichier_cdc) 
            VALUES (:id_etudiant, :id_enseignant, :nomBinome, :theme, :fichier_cdc)
        ");

        $stmt->execute([
            ':id_etudiant' => $id_etudiant,
            ':id_enseignant' => $id_enseignant, // NULL si pas d'enseignant
            ':nomBinome' => $nomBinome,
            ':theme' => $theme,
            ':fichier_cdc' => $filePath
        ]);

        // Message de succès
        $_SESSION['success'] = "Votre soumission a été enregistrée avec succès.";
        header('Location: formulaire.php');
        exit;

    } catch (Exception $e) {
        echo '<div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">';
        echo 'Erreur : ' . htmlspecialchars($e->getMessage());
        echo '</div>';
    }
}

// Fonction pour récupérer les soumissions
function getSoumissions(): array
{
    global $db; // Utilise la connexion déjà créée
    try {
        $pdo = $db->getPDO();
        $stmt = $pdo->query("SELECT * FROM soumissions");
        return ['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
    }
}

?>
