
<?php
class ParentModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM parents");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM parents WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function add($nom, $prenom, $contact, $email) {
        $stmt = $this->db->prepare("INSERT INTO parents (nom, prenom, contact, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nom, $prenom, $contact, $email);
        $stmt->execute();
    }

    public function update($id, $nom, $prenom, $contact, $email) {
        $stmt = $this->db->prepare("UPDATE parents SET nom = ?, prenom = ?, contact = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nom, $prenom, $contact, $email, $id);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM parents WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>
