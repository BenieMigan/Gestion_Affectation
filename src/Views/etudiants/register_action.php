<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['prof'] = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'specialite' => $_POST['specialite']
    ];

    // Redirige vers la page de connexion
    header('Location: login.php');
    exit;
}
?>
