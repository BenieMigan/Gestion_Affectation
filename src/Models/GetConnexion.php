<?php
namespace App\Models;

use PDO;
use PDOException;

class GetConnexion
{
    private PDO $pdo;

    // Connexion avec ou sans base de données
    public function __construct(string $host, string $user, string $password, string $dbName = '')
    {
        try {
            $dsn = empty($dbName)
                ? "mysql:host=$host"                          // Connexion au serveur sans base
                : "mysql:host=$host;dbname=$dbName";          // Connexion à une base précise

            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
