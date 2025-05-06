<?php
require_once 'Database.php';

class Admin {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function seConnecter($email, $mot_de_passe) {
        $sql = "SELECT * FROM admins WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {
            return $admin;
        }

        return false;
    }

    public function ajouter($email, $mot_de_passe) {
        $sql = "INSERT INTO admins (email, mot_de_passe) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$email, password_hash($mot_de_passe, PASSWORD_DEFAULT)]);
    }
}
