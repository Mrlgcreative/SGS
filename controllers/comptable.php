
<?php
require 'models/EleveModel.php';
require 'models/PaiementModel.php';
require 'models/ParentModel.php';

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
        require 'views/comptable/paiements.php';
    }

    public function ajoutPaiement() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $eleve_id = $_POST['eleve_id'];
            $montant = $_POST['montant'];
            $date_paiement = $_POST['date_paiement'];
            $this->paiementModel->add($eleve_id, $montant, $date_paiement);
            header('Location: ' . BASE_URL . 'index.php?controller=Comptable&action=paiements');
        } else {
            require 'views/comptable/ajout_paiement.php';
        }
    }

    public function inscriptions() {
        $eleves = $this->eleveModel->getAll();
        require 'views/comptable/inscriptions.php';
    }

    public function ajoutInscription() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $date_naissance = $_POST['date_naissance'];
            $adresse = $_POST['adresse'];
            $contact = $_POST['contact'];
            $id_parent = $_POST['id_parent'];
            $classe = $_POST['classe'];
            $frais_status = $_POST['frais_status'];
            $this->eleveModel->add($nom, $prenom, $date_naissance, $adresse, $contact, $id_parent, $classe, $frais_status);
            header('Location: ' . BASE_URL . 'index.php?controller=Comptable&action=inscriptions');
        } else {
            $parents = $this->parentModel->getAll();
            require 'views/comptable/ajout_inscription.php';
        }
    }
}
?>


