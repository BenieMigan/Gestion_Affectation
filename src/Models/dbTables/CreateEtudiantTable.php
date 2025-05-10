<?php
namespace App\Models\dbTables;

use App\Models\GetConnexion;
use PDO;

class CreateEtudiantTable
{
    private PDO $pdo;

    public function __construct(GetConnexion $connexion)
    {
        $this->pdo = $connexion->getPDO();
    }

    // Crée la table 'etudiants'
    public function createTable(): bool
    {
        try {
            $sql = "
                CREATE TABLE IF NOT EXISTS etudiants (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nom VARCHAR(255) NOT NULL,
                    prenom VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    domaine VARCHAR(255) NOT NULL
                );
            ";
            $this->pdo->exec($sql);
            #echo "Table 'etudiants' créée avec succès.\n";
            return true;
        } catch (\PDOException $e) {
            echo "Erreur création table 'etudiants' : " . $e->getMessage() . "\n";
            return false;
        }
    }
}
