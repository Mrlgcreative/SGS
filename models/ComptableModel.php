
<?php
require_once 'config/config.php';

class ComptableModel {
    private $db;

    public function __construct() {
        // Initialisation de la connexion à la base de données
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->db->connect_error) {
            die("Erreur de connexion à la base de données : " . $this->db->connect_error);
        }
    }

    // Méthode pour récupérer tous les paiements
    public function getAllPayments() {
        $query = "SELECT * FROM frais";
        $result = $this->db->query($query);

        if ($result === false) {
            throw new Exception("Erreur lors de l'exécution de la requête : " . $this->db->error);
        }

        $payments = $result->fetch_all(MYSQLI_ASSOC);
        return $payments;
    }

    // Méthode pour générer un rapport financier
    public function generateFinancialReport() {
        $query = "SELECT SUM(amount_paid) AS total_revenue FROM paiements_frais";
        $result = $this->db->query($query);

        if ($result === false) {
            throw new Exception("Erreur lors de la génération du rapport financier : " . $this->db->error);
        }

        $row = $result->fetch_assoc();
        return $row['total_revenue'] ?? 0; // Retourne 0 si aucune donnée
    }

    // Méthode pour ajouter un paiement
    public function addPayment($student_id, $fee_id, $amount_paid, $payment_date) {
        $query = "INSERT INTO fee_payments (student_id, frais_id, amount_paid, payment_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);

        if ($stmt === false) {
            throw new Exception("Erreur lors de la préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param('iids', $student_id, $fee_id, $amount_paid, $payment_date);
        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        $stmt->close();
        return true;
    }

    // Méthode pour récupérer tous les frais
    public function getAllFees() {
        $query = "SELECT * FROM fees";
        $result = $this->db->query($query);

        if ($result === false) {
            throw new Exception("Erreur lors de l'exécution de la requête : " . $this->db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Méthode pour ajouter un frais
    public function addFee($name, $amount, $due_date) {
        $query = "INSERT INTO fees (name, amount, due_date) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);

        if ($stmt === false) {
            throw new Exception("Erreur lors de la préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param('sds', $name, $amount, $due_date);
        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        $stmt->close();
        return true;
    }

    // Méthode pour ajouter un comptable
    public function add($nom, $prenom, $contact, $email, $adresse, ) {
        $query = "INSERT INTO comptable (nom, prenom, contact, email, adresse) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);

        if ($stmt === false) {
            throw new Exception("Erreur lors de la préparation de la requête : " . $this->db->error);
        }

        $stmt->bind_param("ssssss", $nom, $prenom, $contact, $email, $adresse);
        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        $stmt->close();
        return true;
    }

    // Méthode pour fermer la connexion à la base de données
    public function closeConnection() {
        if ($this->db) {
            $this->db->close();
        }
   }
}
?>
