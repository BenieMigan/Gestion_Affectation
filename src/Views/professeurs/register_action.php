<?php
// Vérifier que le formulaire a bien été envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Sécuriser le mot de passe
    $domaine = implode(",", $_POST['domaine']);  // Convertir les domaines sélectionnés en une chaîne

    // Connexion à la base de données
    try {
        $host = 'localhost';
        $user = 'root';
        $passwordDB = '';
        $dbname = 'ma_base_test';

        // Créer la connexion PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $passwordDB);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insérer les données dans la base de données
        $stmt = $pdo->prepare("INSERT INTO enseignants(nom, prenom, email, password, domaine) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $password, $domaine]);

        // Rediriger après l'inscription réussie
        header("Location: login.php");
        exit();

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
