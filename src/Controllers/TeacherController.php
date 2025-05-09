<?php

namespace App\Controllers;

use App\Models\GetConnexion;
use PDO;

class TeacherController
{
    private static GetConnexion $db;

    public static function init(GetConnexion $connexion): void
    {
        self::$db = $connexion;
    }

    public function create(array $data): array
    {
        $nom = $data['nom'] ?? null;
        $prenom = $data['prenom'] ?? null;
        $email = filter_var($data['email'] ?? null, FILTER_VALIDATE_EMAIL);
        $domaine = $data['domaine'] ?? null;

        if (!$nom || !$prenom || !$email || !$domaine) {
            return ['success' => false, 'message' => 'Tous les champs sont requis.'];
        }

        try {
            $pdo = self::$db->getPDO();

            // Vérifier si l'email existe déjà
            $stmt = $pdo->prepare("SELECT id FROM enseignants WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'Email déjà utilisé.'];
            }

            $stmt = $pdo->prepare("INSERT INTO enseignants (nom, prenom, email, domaine) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $email, $domaine]);

            return ['success' => true, 'message' => 'Enseignant ajouté avec succès.'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function readAll(): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->query("SELECT * FROM enseignants");
            return ['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function readOne(int $id): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("SELECT * FROM enseignants WHERE id = ?");
            $stmt->execute([$id]);
            $enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$enseignant) {
                return ['success' => false, 'message' => 'Enseignant introuvable.'];
            }

            return ['success' => true, 'data' => $enseignant];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function update(int $id, array $data): array
    {
        $nom = $data['nom'] ?? null;
        $prenom = $data['prenom'] ?? null;
        $email = filter_var($data['email'] ?? null, FILTER_VALIDATE_EMAIL);
        $domaine = $data['domaine'] ?? null;

        if (!$nom || !$prenom || !$email || !$domaine) {
            return ['success' => false, 'message' => 'Tous les champs sont requis.'];
        }

        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("UPDATE enseignants SET nom = ?, prenom = ?, email = ?, domaine = ? WHERE id = ?");
            $stmt->execute([$nom, $prenom, $email, $domaine, $id]);

            return ['success' => true, 'message' => 'Enseignant mis à jour.'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function delete(int $id): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("DELETE FROM enseignants WHERE id = ?");
            $stmt->execute([$id]);

            return ['success' => true, 'message' => 'Enseignant supprimé.'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }
}
