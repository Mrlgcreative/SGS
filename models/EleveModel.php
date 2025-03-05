
<?php
class EleveModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll() {
        $result = $this->db->query("SELECT e.*, p.nom AS parent_nom, p.prenom AS parent_prenom FROM eleves e LEFT JOIN parents p ON e.id_parent = p.id");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT e.*, p.nom AS parent_nom, p.prenom AS parent_prenom FROM eleves e LEFT JOIN parents p ON e.id_parent = p.id WHERE e.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function add($nom, $prenom, $date_naissance, $adresse, $contact, $id_parent, $classe, $frais_status) {
        $stmt = $this->db->prepare("INSERT INTO eleves (nom, prenom, date_naissance, adresse, contact, id_parent, classe, frais_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nom, $prenom, $date_naissance, $adresse, $contact, $id_parent, $classe, $frais_status);
        $stmt->execute();
    }

    public function update($id, $nom, $prenom, $date_naissance, $adresse, $contact, $id_parent, $classe, $frais_status) {
        $stmt = $this->db->prepare("UPDATE eleves SET nom = ?, prenom = ?, date_naissance = ?, adresse = ?, contact = ?, id_parent = ?, classe = ?, frais_status = ? WHERE id = ?");
        $stmt->bind_param("ssssssssi", $nom, $prenom, $date_naissance, $adresse, $contact, $id_parent, $classe, $frais_status, $id);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM eleves WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>

