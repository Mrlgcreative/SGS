
<?php
require_once 'config/config.php';

class ComptableModel {
    private $db;

    public function __construct() {
        // Initialiser la connexion à la base de données
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->db->connect_error) {
            die("Erreur de connexion à la base de données : " . $this->db->connect_error);
        }
    }



    public function getAllPayments() {
        $query = "SELECT * FROM frais";
        $result = $this->db->query($query);

        if ($result === false) {
            echo "Erreur lors de l'exécution de la requête : " . $this->db->error;
            return false;
        }

        $payments = [];
        while ($row = $result->fetch_assoc()) {
            $payments[] = $row;
        }

        return $payments;
    }

    public function generateFinancialReport() {
        $query = "SELECT SUM(amount_paid) AS total_revenue FROM fee_payments";
        $result = $this->db->query($query);

        if ($result === false) {
            echo "Erreur lors de la génération du rapport financier : " . $this->db->error;
            return false;
}
$row = $result->fetch_assoc();
        return $row['total_revenue'];
    }




    // Méthode pour ajouter un paiement
    public function addPayment($student_id, $fee_id, $amount_paid, $payment_date) {
        $query = "INSERT INTO fee_payments (student_id, fee_id, amount_paid, payment_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            echo "Erreur lors de la préparation de la requête : " . $this->db->error;
            return false;
        }

        $stmt->bind_param('iids', $student_id, $fee_id, $amount_paid, $payment_date);
        $result = $stmt->execute();

        if ($result === false) {
            echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
            return false;
        }

        return true;
    }

    // Méthode pour obtenir tous les frais
    public function getAllFees() {
        $query = "SELECT * FROM fees";
        $result = $this->db->query($query);

        if ($result === false) {
            echo "Erreur lors de l'exécution de la requête : " . $this->db->error;
            return false;
        }

        $fees = [];
        while ($row = $result->fetch_assoc()) {
            $fees[] = $row;
        }

        return $fees;
    }

    // Méthode pour ajouter un frais
    public function addFee($name, $amount, $due_date) {
        $query = "INSERT INTO fees (name, amount, due_date) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            echo "Erreur lors de la préparation de la requête : " . $this->db->error;
            return false;
        }

        $stmt->bind_param('sds', $name, $amount, $due_date);
        $result = $stmt->execute();

        if ($result === false) {
            echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
            return false;
        }

        return true;
    }

    public function add($nom, $prenom, $contact, $email, $adresse, $section) {
        $stmt = $this->db->prepare("INSERT INTO comptable (nom, prenom, contact, email, adresse, section) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nom, $prenom, $contact, $email, $adresse, $section);
        $stmt->execute();
    }


    // Méthode pour générer un rapport financier
}
?>

