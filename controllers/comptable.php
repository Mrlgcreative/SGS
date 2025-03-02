
<?php
require 'models/EleveModel.php';
require 'models/PaiementModel.php';
require 'models/ParentModel.php';
 // Assurez-vous d'inclure le fichier de configuration pour la connexion à la base de données

class Comptable {
    private $eleveModel;
    private $paiementModel;
    private $parentModel;

    public function __construct() {
        $this->eleveModel = new EleveModel();
        $this->paiementModel = new PaiementModel();
        $this->parentModel = new ParentModel();
    }

    public function accueil() {
        require 'views/comptable/accueil.php';
    }

    public function paiements() {
        $paiements = $this->paiementModel->getAll();
        require 'views/comptable/paiement.php';
    }

    public function ajoutPaiement() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $mysqli; // Utilisez la connexion MySQLi globale
            $eleve_id = $_POST['eleve_id'];
            $frai_id = $_POST['frai_id'];
            $amount_paid = $_POST['amount_paid'];
            $payment_date = $_POST['payment_date'];
            $created_at = $_POST['created_at'];
            $mois = $_POST['mois'];
            $classe_id = $_POST['classe_id'];
            $option_id = !empty($_POST['option_id']) ? $_POST['option_id'] : NULL;
            $section = $_POST['section'];
            
            $this->paiementModel->add($eleve_id, $frai_id, $amount_paid, $payment_date, $created_at, $mois, $classe_id, $option_id, $section);
            $paiement_id = $this->paiementModel->getLastInsertedId();
            header('Location: ' . BASE_URL . 'index.php?controller=Comptable&action=recu&eleve_id=' . $eleve_id . '&paiement_id=' . $paiement_id);
            exit();
        } else {
            require 'views/comptable/ajout_paiement.php';
        }
    }
    

    public function inscris() {
        $eleves = $this->eleveModel->getAll();
        require 'views/comptable/inscris.php';
    }

    
    public function ajoutInscription() {
        global $mysqli; // Utilisez la connexion MySQLi globale
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $date_naissance = $_POST['date_naissance'];
            $sexe = $_POST['sexe'];
            $section = $_POST['section'];
            $option = !empty($_POST['option']) ? $_POST['option'] : NULL;
            $classe_id = $_POST['classe_id'];
            $adresse = $_POST['adresse'];
            $contact = $_POST['contact'];
            $parent_id = $_POST['parent_id'];
            $frais_status = $_POST['frais_status'];
    
            $stmt = $mysqli->prepare("INSERT INTO eleves (nom, prenom, date_naissance, sexe, section, option, classe_id, adresse, contact, parent_id, frais_status) 
                                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssissis", $nom, $prenom, $date_naissance, $sexe, $section, $option, $classe_id, $adresse, $contact, $parent_id, $frais_status);
    
            if ($stmt->execute()) {
                echo "Inscription réussie!";
                $eleve_id = $mysqli->insert_id;
                header('Location: ' . BASE_URL . 'index.php?controller=Comptable&action=recu&eleve_id=' . $eleve_id . '&paiement_id=' . $this->paiementModel->getLastInsertedId());
                exit();
            } else {
                echo "Erreur lors de l'inscription: " . $stmt->error;
            }
    
            $stmt->close();
        } else {
            require 'views/comptable/inscription.php';
        }
    }
    
   
    public function recu() {
        if (isset($_GET['eleve_id']) && isset($_GET['paiement_id'])) {
            $eleve_id = $_GET['eleve_id'];
            $paiement_id = $_GET['paiement_id'];
            require 'views/comptable/recu.php';
        } else {
            echo "ID de l'élève ou du paiement manquant.";
        }
    }

}
?>
