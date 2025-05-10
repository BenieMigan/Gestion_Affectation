<?php
namespace App\Models;

use App\Models\GetConnexion;

class Database
{
    private GetConnexion $db;

    public function __construct(GetConnexion $db)
    {
        $this->db = $db;
    }

    // Crée la base de données si elle n'existe pas
    public function createDatabase(string $dbName): bool
    {
        try {
            $sql = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            $this->db->getPDO()->exec($sql);
            #echo "<> Base de données '$dbName' mise en place \n";
            return true;
        } catch (\PDOException $e) {
            echo "Erreur lors de la création de la base de données : " . $e->getMessage();
            return false;
        }
    }
}
