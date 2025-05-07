<?php
require_once 'Database.php';

class Soumission {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function ajouter($id_etudiant, $nom_binome, $intitule) {
        $sql = "INSERT INTO soumissions (id_etudiant, nom_binome, intitule) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id_etudiant, $nom_binome, $intitule]);
    }

    public function getParEtudiant($id_etudiant) {
        $sql = "SELECT * FROM soumissions WHERE id_etudiant = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_etudiant]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
