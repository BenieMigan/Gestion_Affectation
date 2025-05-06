<?php
namespace App\Models\dbTables;

use App\Models\GetConnexion;
use PDO;

class CreateAdminTable
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
                CREATE TABLE IF NOT EXISTS admins (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    adminPassword VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );
            ";
            $this->pdo->exec($sql);
            echo "Table 'admins' créée avec succès.\n";
            return true;
        } catch (\PDOException $e) {
            echo "Erreur création table 'admins' : " . $e->getMessage() . "\n";
            return false;
        }
    }
}
