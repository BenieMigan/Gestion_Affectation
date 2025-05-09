<?php

namespace App\Controllers;

use App\Models\GetConnexion;
use PDO;

class StudentController
{
    private static GetConnexion $db;

    public static function init(GetConnexion $connexion): void
    {
        self::$db = $connexion;
    }

    public function readAll(): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->query("SELECT id, nom, email FROM etudiants");
            return ['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function readOne(int $id): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("SELECT id, nom, email FROM etudiants WHERE id = ?");
            $stmt->execute([$id]);
            $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$etudiant) {
                return ['success' => false, 'message' => 'Étudiant introuvable.'];
            }

            return ['success' => true, 'data' => $etudiant];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function update(int $id, array $data): array
    {
        $nom = $data['nom'] ?? null;
        $email = filter_var($data['email'] ?? null, FILTER_VALIDATE_EMAIL);

        if (!$nom || !$email) {
            return ['success' => false, 'message' => 'Nom ou email invalide.'];
        }

        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("UPDATE etudiants SET nom = ?, email = ? WHERE id = ?");
            $stmt->execute([$nom, $email, $id]);

            return ['success' => true, 'message' => 'Étudiant mis à jour.'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function delete(int $id): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
            $stmt->execute([$id]);

            return ['success' => true, 'message' => 'Étudiant supprimé.'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function voirEncadreur(int $id_etudiant): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("
            SELECT e.nom, e.prenom, e.domaine
            FROM affectations a
            JOIN enseignants e ON a.id_enseignant = e.id
            WHERE a.id_etudiant = ?
        ");
            $stmt->execute([$id_etudiant]);
            $encadreur = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$encadreur) {
                return ['success' => false, 'message' => 'Aucun encadreur attribué'];
            }

            return ['success' => true, 'encadreur' => $encadreur];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function demanderAffectation(int $id_etudiant): array
    {
        try {
            $pdo = self::$db->getPDO();


            $stmt = $pdo->prepare("SELECT * FROM demandes_affectation WHERE id_etudiant = ? AND statut = 'en_attente'");
            $stmt->execute([$id_etudiant]);
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'Une demande est déjà en attente'];
            }


            $stmt = $pdo->prepare("SELECT * FROM affectations WHERE id_etudiant = ?");
            $stmt->execute([$id_etudiant]);
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'Vous avez déjà un encadreur'];
            }


            $stmt = $pdo->prepare("INSERT INTO demandes_affectation (id_etudiant) VALUES (?)");
            $stmt->execute([$id_etudiant]);

            return ['success' => true, 'message' => 'Demande d’affectation envoyée avec succès'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

}
