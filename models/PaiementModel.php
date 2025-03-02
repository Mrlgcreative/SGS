
<?php
class PaiementModel {
    private $db;

    public function __construct() {
        // Connexion à la base de données
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Erreur de connexion : " . $this->db->connect_error);
        }
    }

    public function getAll() {
        // Requête pour récupérer tous les paiements avec les informations associées
        $sql = "SELECT p.*, 
                       e.nom AS eleve_nom, 
                       e.prenom AS eleve_prenom, 
                       c.nom AS classe_nom, 
                       o.nom AS option_nom
                FROM paiements_frais p
                LEFT JOIN eleves e ON p.eleve_id = e.id
                LEFT JOIN classes c ON p.classe_id = c.id
                LEFT JOIN options o ON p.option_id = o.id";
        $result = $this->db->query($sql);

        if (!$result) {
            throw new Exception("Erreur lors de la récupération des paiements : " . $this->db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        // Préparation de la requête pour un paiement spécifique
        $stmt = $this->db->prepare("SELECT p.*, 
                                           e.nom AS eleve_nom, 
                                           e.prenom AS eleve_prenom, 
                                           c.nom AS classe_nom, 
                                           o.nom AS option_nom
                                    FROM paiements_frais p
                                    LEFT JOIN eleves e ON p.eleve_id = e.id
                                    LEFT JOIN classes c ON p.classe_id = c.id
                                    LEFT JOIN options o ON p.option_id = o.id
                                    WHERE p.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_assoc();
    }

    public function add($eleve_id, $frais_id, $amount_paid, $payment_date, $created_at, $mois, $classe_id, $option_id, $section) {
        // Préparation de la requête pour insérer un nouveau paiement
        $stmt = $this->db->prepare("INSERT INTO paiements_frais 
                                    (eleve_id, frais_id, amount_paid, payment_date, created_at, mois, classe_id, option_id, section) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssssis", $eleve_id, $frais_id, $amount_paid, $payment_date, $created_at, $mois, $classe_id, $option_id, $section);

        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'insertion du paiement : " . $stmt->error);
        }

        $stmt->close();
    }

    public function update($id, $eleve_id, $frais_id, $amount_paid, $payment_date, $created_at, $mois, $classe_id, $option_id, $section) {
        // Préparation de la requête pour mettre à jour un paiement existant
        $stmt = $this->db->prepare("UPDATE paiements_frais 
                                    SET eleve_id = ?, 
                                        frais_id = ?, 
                                        amount_paid = ?, 
                                        payment_date = ?, 
                                        created_at = ?, 
                                        mois = ?, 
                                        classe_id = ?, 
                                        option_id = ?, 
                                        section = ? 
                                    WHERE id = ?");
        $stmt->bind_param("iisssssisi", $eleve_id, $frais_id, $amount_paid, $payment_date, $created_at, $mois, $classe_id, $option_id, $section, $id);

        if (!$stmt->execute()){
            throw new Exception("Erreur lors de la mise à jour du paiement : " . $stmt->error);
        }

        $stmt->close();
    }

    public function delete($id) {
        // Préparation de la requête pour supprimer un paiement
        $stmt = $this->db->prepare("DELETE FROM paiements_frais WHERE id = ?");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de la suppression du paiement : " . $stmt->error);
        }

        $stmt->close();
    }

    public function getLastInsertedId() {
        // Récupérer le dernier ID inséré
        return $this->db->insert_id;
    }
}
?>
