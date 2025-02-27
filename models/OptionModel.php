
<?php
class OptionModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM options");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM options WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function add($nom, $description) {
        $stmt = $this->db->prepare("INSERT INTO options (nom, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $nom, $description);
        $stmt->execute();
    }

    public function update($id, $nom, $description) {
        $stmt = $this->db->prepare("UPDATE options SET nom = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nom, $description, $id);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM options WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>
