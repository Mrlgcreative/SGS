
<?php
require 'models/EleveModel.php';
require 'models/ProfesseurModel.php';
require 'models/FraisModel.php';
require 'models/HistoriqueModel.php';
require 'models/UserModel.php';
require 'models/ParentModel.php';
require 'models/CoursModel.php';
require 'models/ClasseModel.php';
require 'models/ComptableModel.php';
require 'models/DirectorModel.php';
require 'models/DirectriceModel.php';
require 'models/PrefetModel.php';
require 'models/EmployeModel.php';


class Admin {
    private $eleveModel;
    private $professeurModel;
    private $fraisModel;
    private $historiqueModel;
    private $userModel;
    private $parentModel;
    private $coursModel;
    private $classeModel;
    private $comptableModel;
    private $directorModel;
    private $directriceModel;
    private $prefetModel;
    private $employeModel;

    public function __construct() {
        $this->eleveModel = new EleveModel();
        $this->professeurModel = new ProfesseurModel();
        $this->fraisModel = new FraisModel();
        $this->historiqueModel = new HistoriqueModel();
        $this->userModel = new UserModel();
        $this->parentModel = new ParentModel();
        $this->coursModel = new CoursModel();
        $this->classeModel = new ClasseModel();
        $this->comptableModel=new ComptableModel();
        $this->directorModel= new DirectorModel();  
        $this->directriceModel=new DirectorModel();
        $this->prefetModel=new PrefetModel();
     }

    public function accueil() {
        require 'views/admin/accueil.php';
    }

    public function eleves() {
        $eleves = $this->eleveModel->getAll();
        require 'views/admin/eleve.php';
    }

    public function ajoutEleve() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement du formulaire d'ajout d'un élève
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
    
            $eleveModel = new EleveModel();
            $eleveModel->add($nom, $prenom, $date_naissance, $sexe, $section, $option, $classe_id, $adresse, $contact, $parent_id, $frais_status);
    
            // Rediriger après ajout
            header("Location: " . BASE_URL . "index.php?controller=Admin&action=eleves");
        } else {
            $classeModel = new ClasseModel();
            $classes = $classeModel->getAllClasses(); // Récupération des classes
            $parentModel = new ParentModel();
            $parents = $parentModel->getAllParents(); // Récupération des parents
            include 'views/admin/add_eleve.php';
        }
    }   
    

    public function professeurs() {
        $professeurs = $this->professeurModel->getAll();
        require 'views/admin/professeurs.php';
    }
    

    public function ajoutProfesseur() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $adresse=$_POST['adresse'];
            $classe_id = $_POST['classe_id'];
            $cours_id=$_POST['cours_id'];
            $section =$_POST['section'];
            
            $this->professeurModel->add($nom, $prenom,$contact, $email,$adresse,   $classe_id,
            $cours_id,  $section);
            header('Location: ' . BASE_URL . 'index.php?controller=Admin&action=professeurs');
        } else {
            require 'views/admin/ajout_professeur.php';
        }
    }

    public function frais() {
        $frais = $this->fraisModel->getAll();
        require 'views/admin/frais.php';
    }

    public function ajoutFrais() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $montant = $_POST['montant'];
            $description = $_POST['description'];
            $section = $_POST['section'];
            $this->fraisModel->add($montant, $description, $section);
            header('Location: ' . BASE_URL . 'index.php?controller=Admin&action=frais');
        } else {
            require 'views/admin/ajout_frais.php';
        }
    }

    public function paiementProfs() {
        require 'views/admin/paiement_profs.php';
    }

    public function directeurs() {
        $directeurs = $this->userModel->getByRole('director');
        require 'views/admin/directeurs.php';
    }
    public function rapport() {
        $userModel = new UserModel();
        $feeModel = new FeeModel();
        $attendanceModel = new AttendanceModel();
        $comptableModel = new ComptableModel();
    
        // Récupérer les données
        $totalUsers = $userModel->getTotalUsers();
        $totalFees = $feeModel->getTotalFees();
        $totalPayments = $comptableModel->getAllPayments();
        $totalAttendances = $attendanceModel->getTotalAttendances();
        $financialReport = $comptableModel->generateFinancialReport();
    
        // Passer les données à la vue
        include 'views/admin/rapport.php';
    }

    public function directrices() {
        $directrices = $this->userModel->getByRole('directrice');
        require 'views/admin/directrices.php';
    }

    public function prefets() {
        $prefets = $this->userModel->getByRole('prefet');
        require 'views/admin/prefets.php';
    }

    public function addprefet(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nom= $_POST['nom'];
            $prenom= $_POST['prenom'];
            $contact=$_POST['contact'];
            $email=$_POST['email'];
            $adresse=$_POST['adresse'];
            $section=$_POST['section'];
            $this->prefetModel->add($nom, $prenom, $contact, $email, $adresse, $section);
            header('Location: ' .BASE_URL . 'index.php?controller=Admin&action=prefet');

        }else{
            require 'views/admin/add_prefet.php';
        }
    }

  // Méthode pour lister les employés
public function employes() {
    $employeModel = new EmployeModel();
    $employes = $employeModel->getAll();

    include 'views/admin/employes.php';
}

// Méthode pour ajouter un employé
public function ajoutemployes() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Traitement du formulaire d'ajout d'un employé
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $adresse= $_POST['adresse'];
        $poste = $_POST['poste'];

        $employeModel = new EmployeModel();
        $employeModel->add($nom, $prenom, $email, $contact,$adresse, $poste);

        // Rediriger après ajout
        header("Location: " . BASE_URL . "index.php?controller=Admin&action=employes");
    } else {
        include 'views/admin/ajout_employe.php';
    }
}

// Méthode pour modifier un employé
public function editEmploye() {
    $employeModel = new EmployeModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Traitement du formulaire de modification d'un employé
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $poste = $_POST['poste'];

        $employeModel->update($id, $nom, $prenom, $email, $contact, $poste);

        // Rediriger après modification
        header("Location: " . BASE_URL . "index.php?controller=Admin&action=employes");
    } else {
        $id = $_GET['id'];
        $employe = $employeModel->getById($id);
        include 'views/admin/edit_employe.php';
    }
}

// Méthode pour supprimer un employé
public function deleteEmploye() {
    $id = $_GET['id'];
    $employeModel = new EmployeModel();
    $employeModel->delete($id);

    // Rediriger après suppression
    header("Location: " . BASE_URL . "index.php?controller=Admin&action=employes");
}

    public function historiques() {
        $historiques = $this->historiqueModel->getAll();
        require 'views/admin/rapport_action.php';
    }

    public function parents() {
        $parents = $this->parentModel->getAll();
        require 'views/admin/parents.php';
    }

    public function cours() {
        $cours = $this->coursModel->getAll();
        require 'views/admin/cours.php';
    }

   
    public function ajoutCours() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement du formulaire d'ajout d'un cours
            $titre = isset($_POST['titre']) ? $_POST['titre'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $professeur = isset($_POST['professeur_id']) ? $_POST['professeur_id'] : null;
            $classe = isset($_POST['classe_id']) ? $_POST['classe_id'] : null;
            $section = isset($_POST['section']) ? $_POST['section'] : null;
            $option = isset($_POST['option']) ? $_POST['option'] : ''; // option peut être null pour certaines sections

            // Vérification que les champs obligatoires ne sont pas vides
            if ($titre && $description && $professeur && $classe && $section) {
                $coursModel = new CoursModel();
                $coursModel->add($titre, $description, $professeur, $classe, $section, $option);

                // Rediriger après ajout
                header("Location: " . BASE_URL . "index.php?controller=Admin&action=cours");
            } else {
                $error = "Tous les champs obligatoires doivent être remplis.";
                include 'views/admin/ajout_cours.php';
            }
        } else {
            include 'views/admin/ajout_cours.php';
        }
    }


    

    public function classes() {
        $classModel = new ClasseModel();
        $classes = $classModel->getAllClasses();
    
        include 'views/admin/classe.php';
    }

    public function addClasse() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $section = $_POST['section'];
            $this->classeModel->add($nom, $section);
            header('Location: ' . BASE_URL . 'index.php?controller=Admin&action=classes');
        } else {
            require 'views/admin/add_classe.php';
        }
    }

    public function comptable() {
        $comptables = $this->userModel->getByRole('comptable');
        require 'views/admin/comptable.php';
    }

    public function addcomptable(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nom= $_POST['nom'];
            $prenom= $_POST['prenom'];
            $contact=$_POST['contact'];
            $email=$_POST['email'];
            $adresse=$_POST['adresse'];
           
            $this->comptableModel->add($nom, $prenom, $contact, $email, $adresse );
            header('Location: ' .BASE_URL . 'index.php?controller=Admin&action=comptable');

        }else{
            require 'views/admin/add_comptable.php';
        }
    }
}
?>

