<?php

namespace App\Controllers;

use App\Models\GetConnexion;

class AuthController
{
    private static GetConnexion $db;

    public static function init(GetConnexion $connexion): void
    {
        self::$db = $connexion;
    }

    public function login(): array
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $mot_de_passe = $_POST['password'] ?? null;

        if (!$email || !$mot_de_passe) {
            return [
                'success' => false,
                'message' => 'Email ou mot de passe manquant ou invalide.'
            ];
        }

        try {
            $pdo = self::$db->getPDO();

            $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$user) {
                return [
                    'success' => false,
                    'message' => 'Aucun compte trouvé avec cet email.'
                ];
            }

            if (!password_verify($mot_de_passe, $user['etudiantPassword'])) {
                return [
                    'success' => false,
                    'message' => 'Mot de passe incorrect.'
                ];
            }

            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nom'] = $user['nom'];

            return [
                'success' => true,
                'message' => 'Connexion réussie.',
                'user' => [
                    'id' => $user['id'],
                    'email' => $user['email'],
                ]
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erreur interne : ' . $e->getMessage()
            ];
        }
    }

    public function register(): array
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $mot_de_passe = $_POST['password'] ?? null;
        $nom = $_POST['nom'] ?? null;

        if (!$email || !$mot_de_passe || !$nom) {
            return [
                'success' => false,
                'message' => 'Champs requis manquants ou invalides.'
            ];
        }

        try {
            $pdo = self::$db->getPDO();


            $stmt = $pdo->prepare("SELECT id FROM etudiants WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                return [
                    'success' => false,
                    'message' => 'Cet email est déjà utilisé.'
                ];
            }


            $hashedPassword = password_hash($mot_de_passe, PASSWORD_BCRYPT);


            $stmt = $pdo->prepare("INSERT INTO etudiants (nom, email, mot_de_passe) VALUES (?, ?, ?)");
            $stmt->execute([$nom, $email, $hashedPassword]);

            $userId = $pdo->lastInsertId();

            //

            return [
                'success' => true,
                'message' => 'Compte créé avec succès.',
                'user' => [
                    'id' => $userId,
                    'email' => $email,
                    'nom' => $nom
                ]
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erreur lors de la création du compte : ' . $e->getMessage()
            ];
        }
    }


     public function logout()
    {
        // Vérifie si une session est active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Supprime toutes les variables de session
        session_unset();

        // Détruit la session
        session_destroy();

        // Redirige vers la page d'accueil ou de connexion
        header('Location: /gestion_affectation/'); // Remplacez par la page adéquate
        exit();
    }
    


}