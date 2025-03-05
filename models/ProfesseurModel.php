
<?php
class ProfesseurModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM professeurs");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM professeurs WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function add($nom, $prenom,$contact, $email,$adresse,  $classe_id, $cours_id, $section) {
        $stmt = $this->db->prepare("INSERT INTO professeurs (nom, prenom, contact,  email, adresse, classe_id, cours_id, section) VALUES (?, ?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param("ssssssss", $nom, $prenom,$contact, $email, $adresse,  $classe_id, $cours_id, $section);
        $stmt->execute();
    }

    public function update($id, $nom, $prenom,$contact, $email, $adresse, $classe_id,$cours_id, $section) {
        $stmt = $this->db->prepare("UPDATE professeurs SET nom = ?, prenom = ?,contact = ?, email = ?, adresse=? , classe_id = ?, cours_id=?, section=? WHERE id = ?");
        $stmt->bind_param("ssssssssi", $nom, $prenom,$contact, $email, $adresse,  $classe_id, $cours_id, $section, $id);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM professeurs WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>

