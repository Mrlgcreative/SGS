
<?php
class PaiementModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll() {
        $result = $this->db->query("SELECT p.*, e.nom AS eleve_nom, e.prenom AS eleve_prenom FROM paiements p LEFT JOIN eleves e ON p.eleve_id = e.id");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT p.*, e.nom AS eleve_nom, e.prenom AS eleve_prenom FROM paiements p LEFT JOIN eleves e ON p.eleve_id = e.id WHERE p.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function add($eleve_id, $montant, $date_paiement) {
        $stmt = $this->db->prepare("INSERT INTO paiements (eleve_id, montant, date_paiement) VALUES (?, ?, ?)");
        $stmt->bind_param("ids", $eleve_id, $montant, $date_paiement);
        $stmt->execute();
    }

    public function update($id, $eleve_id, $montant, $date_paiement) {
        $stmt = $this->db->prepare("UPDATE paiements SET eleve_id = ?, montant = ?, date_paiement = ? WHERE id = ?");
        $stmt->bind_param("idsi", $eleve_id, $montant, $date_paiement, $id);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM paiements WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>

