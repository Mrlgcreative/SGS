
<?php
class FraisModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM frais");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM frais WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function add($montant, $description, $section) {
        $stmt = $this->db->prepare("INSERT INTO frais (montant, description, section) VALUES (?, ?, ?)");
        $stmt->bind_param("dss", $montant, $description, $section);
        $stmt->execute();
    }

    public function update($id, $montant, $description, $section) {
        $stmt = $this->db->prepare("UPDATE frais SET montant = ?, description = ?, section = ? WHERE id = ?");
        $stmt->bind_param("dssi", $montant, $description, $section, $id);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM frais WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function getTotalFees() {
        $result = $this->db->query("SELECT COUNT(*) AS total_fees FROM frais");
        $row = $result->fetch_assoc();
        return $row['total_fees'];
    }
}
?>

