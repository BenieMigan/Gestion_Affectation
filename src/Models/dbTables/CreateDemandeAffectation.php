<?php

namespace App\Models\dbTables;

use App\Models\GetConnexion;
use PDO;

class CreateDemandeAffectation
{

    private PDO $pdo;

    public function __construct(GetConnexion $connexion)
    {
        $this->pdo = $connexion->getPDO();
    }


    public function createTable(): bool
    {
        try {
            $sql = "
            CREATE TABLE IF NOT EXISTS demandes_affectation (
                id INT AUTO_INCREMENT PRIMARY KEY,
                id_etudiant INT NOT NULL,
                statut ENUM('en_attente', 'acceptee', 'refusee') DEFAULT 'en_attente',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (id_etudiant) REFERENCES etudiants(id)
            );
        ";
            $this->pdo->exec($sql);
            echo "Table 'demandeAffectations' créée avec succès.\n";
            return true;
        } catch (\PDOException $e) {
            echo "Erreur création table 'admins' : " . $e->getMessage() . "\n";
            return false;
        }
    }
}