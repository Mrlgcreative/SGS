
<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getTotalUsers() {
        $result = $this->db->query("SELECT COUNT(*) AS total_users FROM users");
        $row = $result->fetch_assoc();
        return $row['total_users'];
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function add($username, $email, $password, $role) {
        $stmt = $this->db->prepare("INSERT INTO users (username,email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username,$email, $password, $role);
        $stmt->execute();
    }

    public function update($id, $username,$email, $password, $role) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email=?, password = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $username,$email, $password, $role, $id);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function getByRole($role) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE role = ?");
        $stmt->bind_param("s", $role);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function register($username, $name, $email, $password,$role){
        $query = "INSERT INTO users (username, name, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);

        if ($stmt === false) {
            echo "Erreur lors de la préparation de la requête : " . $this->db->error;
            return false;
        }

        $stmt->bind_param('sssss', $username, $name, $email, $password, $role);
        $result = $stmt->execute();

        if ($result === false) {
            echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
            return false;
        }

        return true;
    }
    
}
?>

