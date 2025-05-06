<?php
class Database {
    private $host = "localhost";
    private $db_name = "affectations";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        if ($this->conn == null) {
            try {
                $this->conn = new PDO(
                    "mysql:host=".$this->host.";dbname=".$this->db_name,
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->exec("SET NAMES utf8");
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}
