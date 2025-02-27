<?php
class EmployeModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM employes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM employes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function add($nom, $prenom, $email, $contact, $poste) {
        $stmt = $this->db->prepare("INSERT INTO employes (nom, prenom, email, contact, poste) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nom, $prenom, $email, $contact, $poste);
        $stmt->execute();
    }

    public function update($id, $nom, $prenom, $email, $contact, $poste) {
        $stmt = $this->db->prepare("UPDATE employes SET nom = ?, prenom = ?, email = ?, contact = ?, poste = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $nom, $prenom, $email, $contact, $poste, $id);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM employes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>