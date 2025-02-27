
<?php
class ClasseModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM classes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM classes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function add($nom, $section) {
        $stmt = $this->db->prepare("INSERT INTO classes (nom, section) VALUES (?, ?)");
        $stmt->bind_param("ss", $nom, $section);
        $stmt->execute();
    }

    public function update($id, $nom, $section) {
        $stmt = $this->db->prepare("UPDATE classes SET nom = ?, section = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nom, $section, $id);
        $stmt->execute();
    }

    public function getAllClasses() {
        $result = $this->db->query("SELECT * FROM classes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM classes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>

