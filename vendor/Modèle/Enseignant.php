<?php
require_once 'Database.php';

class Enseignant {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function ajouter($nom, $prenom, $email, $domaine) {
        $sql = "INSERT INTO enseignants (nom, prenom, email, domaine) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, $domaine]);
    }

    public function getTous() {
        $sql = "SELECT * FROM enseignants";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getParDomaine($domaine) {
        $sql = "SELECT * FROM enseignants WHERE FIND_IN_SET(?, domaine)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$domaine]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
