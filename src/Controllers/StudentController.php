<?php

namespace App\Controllers;

use App\Models\GetConnexion;
use PDO;
use PDOException;

class StudentController
{
    private static GetConnexion $db;

    /**
     * Initialise la connexion à la base de données.
     */
    public static function init(GetConnexion $connexion): void
    {
        self::$db = $connexion;
    }

    /**
     * Récupère tous les étudiants.
     */
    public function readAll(): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->query("SELECT id, nom, email FROM etudiants");
            return ['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    /**
     * Récupère un étudiant par son ID.
     */
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
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    /**
     * Met à jour les informations d’un étudiant.
     */
    public function update(int $id, array $data): array
    {
        $nom = trim($data['nom'] ?? '');
        $email = filter_var(trim($data['email'] ?? ''), FILTER_VALIDATE_EMAIL);

        if (empty($nom) || !$email) {
            return ['success' => false, 'message' => 'Nom ou email invalide.'];
        }

        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("UPDATE etudiants SET nom = ?, email = ? WHERE id = ?");
            $stmt->execute([$nom, $email, $id]);

            return ['success' => true, 'message' => 'Étudiant mis à jour.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    /**
     * Supprime un étudiant.
     */
    public function delete(int $id): array
    {
        try {
            $pdo = self::$db->getPDO();
            $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
            $stmt->execute([$id]);

            return ['success' => true, 'message' => 'Étudiant supprimé.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    /**
     * Affiche l’encadreur d’un étudiant.
     */
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
            $encadreur = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$encadreur) {
                return ['success' => false, 'message' => 'Aucun encadreur attribué.'];
            }

            return ['success' => true, 'encadreur' => $encadreur];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }

    /**
     * Soumet une demande d’affectation d’encadreur.
     */
    public function demanderAffectation(int $id_etudiant): array
    {
        try {
            $pdo = self::$db->getPDO();

            // Vérifie si une demande est déjà en attente
            $stmt = $pdo->prepare("SELECT id FROM demandes_affectation WHERE id_etudiant = ? AND statut = 'en_attente'");
            $stmt->execute([$id_etudiant]);
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'Une demande est déjà en attente.'];
            }

            // Vérifie si un encadreur a déjà été attribué
            $stmt = $pdo->prepare("SELECT id FROM affectations WHERE id_etudiant = ?");
            $stmt->execute([$id_etudiant]);
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'Vous avez déjà un encadreur.'];
            }

            // Crée une nouvelle demande
            $stmt = $pdo->prepare("INSERT INTO demandes_affectation (id_etudiant) VALUES (?)");
            $stmt->execute([$id_etudiant]);

            return ['success' => true, 'message' => 'Demande d’affectation envoyée avec succès.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur : ' . $e->getMessage()];
        }
    }
}
