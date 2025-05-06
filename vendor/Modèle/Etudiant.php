<?php
require_once 'Database.php';

class Etudiant {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function ajouter($nom, $prenom, $email, $mot_de_passe) {
        $sql = "INSERT INTO etudiants (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, password_hash($mot_de_passe, PASSWORD_DEFAULT)]);
    }

    public function trouverParEmail($email) {
        $sql = "SELECT * FROM etudiants WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function aDejaSoumis($id_etudiant) {
        $sql = "SELECT * FROM soumissions WHERE id_etudiant = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_etudiant]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // null si rien trouvé
    }
}
