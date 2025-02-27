
<?php
class HistoriqueModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getAll($section = null) {
        $sql = "SELECT h.*, u.username FROM historique h LEFT JOIN users u ON h.user_id = u.id";
        if ($section) {
            $sql .= " WHERE h.section = ?";
        }
        $stmt = $this->db->prepare($sql);
        if ($section) {
            $stmt->bind_param("s", $section);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($user_id, $action, $section) {
        $stmt = $this->db->prepare("INSERT INTO historique (user_id, action, section) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $action, $section);
        $stmt->execute();
    }
}
?>
