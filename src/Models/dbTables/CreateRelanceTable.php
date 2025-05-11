<?php
namespace App\Models\dbTables;

use App\Models\GetConnexion;
use PDO;

class CreateRelanceTable
{
    private PDO $pdo;

    public function __construct(GetConnexion $connexion)
    {
        $this->pdo = $connexion->getPDO();
    }

    // Crée la table 'relances'
    public function createTable(): bool
    {
        try {
            $sql = "
              CREATE TABLE relances (
                id INT AUTO_INCREMENT PRIMARY KEY,
                id_etudiant INT NOT NULL,
                id_soumission INT NOT NULL,
                message TEXT,
                statut ENUM('en_attente', 'traitee') DEFAULT 'en_attente',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (id_etudiant) REFERENCES etudiants(id),
                FOREIGN KEY (id_soumission) REFERENCES soumissions(id)
                );

            ";
            $this->pdo->exec($sql);
            #echo "Table 'relances' créée avec succès.\n";
            return true;
        } catch (\PDOException $e) {
            echo "Erreur création table 'relances' : " . $e->getMessage() . "\n";
            return false;
        }
    }
}
