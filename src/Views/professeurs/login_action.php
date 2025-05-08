<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifie s'il y a un prof enregistré et si les infos correspondent
    if (isset($_SESSION['prof']) && $_SESSION['prof']['email'] === $email && $_SESSION['prof']['password'] === $password) {
        // Connexion réussie, redirection vers le profil
        header('Location: profile.php');
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>Email ou mot de passe incorrect.</p>";
        echo "<p style='text-align:center;'><a href='login.php'>Réessayer</a></p>";
    }
}
?>
