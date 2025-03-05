
<?php
require_once 'config/config.php';

class CoursModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM cours");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM cours WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getBySection($section) {
        $stmt = $this->db->prepare("SELECT * FROM cours WHERE section = ?");
        $stmt->bind_param("s", $section);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($titre, $description, $professeur, $classe, $section, $option) {
        $stmt = $this->db->prepare("INSERT INTO cours (titre, description , professeur_id, classe_id, section, option_ ) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiss", $titre, $description, $professeur, $classe, $section, $option);
        $stmt->execute();
    }
    

    public function update($id, $titre, $description, $professeur, $classe, $section, $option) {
        $stmt = $this->db->prepare("UPDATE cours SET titre = ?, description = ?, professeur_id = ?, classe_id = ?, section = ?, option_ = ? WHERE id = ?");
        $stmt->bind_param("ssiissi", $titre, $description, $professeur, $classe, $section, $option_, $id);
        $stmt->execute();
    }

     public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM cours WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>


