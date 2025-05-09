<?php

namespace App\Controllers;

use App\Models\GetConnexion;
use PDO;

class AdminController
{
    private static GetConnexion $db;

    public static function init(GetConnexion $connexion): void
    {
        self::$db = $connexion;
    }

    public function login(string $email, string $password): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
            $stmt->execute([$email]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$admin || !password_verify($password, $admin['adminPassword'])) {
                return ['success' => false, 'message' => 'Identifiants invalides'];
            }


            return ['success' => true, 'admin' => $admin];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function listEtudiants(): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->query("SELECT * FROM etudiants");
            return ['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors du chargement des étudiants'];
        }
    }

    public function listEnseignants(): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->query("SELECT * FROM enseignants");
            return ['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors du chargement des enseignants'];
        }
    }

    public function affecterEncadreur(int $id_etudiant, int $id_enseignant): array
    {
        try {
            $pdo = self::$db->getPDO();

            $stmt = $pdo->prepare("SELECT id FROM etudiants WHERE id = ?");
            $stmt->execute([$id_etudiant]);
            if (!$stmt->fetch()) {
                return ['success' => false, 'message' => 'Étudiant introuvable'];
            }


            $stmt = $pdo->prepare("SELECT id FROM enseignants WHERE id = ?");
            $stmt->execute([$id_enseignant]);
            if (!$stmt->fetch()) {
                return ['success' => false, 'message' => 'Enseignant introuvable'];
            }

            // Vérifier si une affectation existe déjà
            $stmt = $pdo->prepare("SELECT * FROM affectations WHERE id_etudiant = ?");
            $stmt->execute([$id_etudiant]);
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'Cet étudiant a déjà un encadreur'];
            }

            // Créer l’affectation
            $stmt = $pdo->prepare("INSERT INTO affectations (id_etudiant, id_enseignant) VALUES (?, ?)");
            $stmt->execute([$id_etudiant, $id_enseignant]);

            return ['success' => true, 'message' => 'Encadreur affecté avec succès'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de l’affectation : ' . $e->getMessage()];
        }
    }

    public function listerDemandes(): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->query("
            SELECT d.id, d.id_etudiant, e.nom, e.prenom, d.statut, d.created_at
            FROM demandes_affectation d
            JOIN etudiants e ON d.id_etudiant = e.id
            WHERE d.statut = 'en_attente'
        ");
            return ['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function validerDemande(int $id_demande, int $id_enseignant): array
    {
        try {
            $pdo = self::$db->getPDO();

            // Récupérer la demande
            $stmt = $pdo->prepare("SELECT * FROM demandes_affectation WHERE id = ? AND statut = 'en_attente'");
            $stmt->execute([$id_demande]);
            $demande = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$demande) {
                return ['success' => false, 'message' => 'Demande introuvable ou déjà traitée'];
            }

            $id_etudiant = $demande['id_etudiant'];

            // Vérifie que l'étudiant n'a pas déjà un encadreur
            $stmt = $pdo->prepare("SELECT * FROM affectations WHERE id_etudiant = ?");
            $stmt->execute([$id_etudiant]);
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'Cet étudiant a déjà un encadreur'];
            }

            // Créer l’affectation
            $stmt = $pdo->prepare("INSERT INTO affectations (id_etudiant, id_enseignant) VALUES (?, ?)");
            $stmt->execute([$id_etudiant, $id_enseignant]);

            // Mettre à jour la demande comme acceptée
            $stmt = $pdo->prepare("UPDATE demandes_affectation SET statut = 'acceptee' WHERE id = ?");
            $stmt->execute([$id_demande]);

            return ['success' => true, 'message' => 'Encadreur affecté et demande validée'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    public function refuserDemande(int $id_demande): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("UPDATE demandes_affectation SET statut = 'refusee' WHERE id = ? AND statut = 'en_attente'");
            $stmt->execute([$id_demande]);

            if ($stmt->rowCount() === 0) {
                return ['success' => false, 'message' => 'Demande introuvable ou déjà traitée'];
            }

            return ['success' => true, 'message' => 'Demande refusée avec succès'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }



}
