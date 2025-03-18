
<?php
require 'models/UserModel.php';

class Auth {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->getByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
               
                switch ($_SESSION['role']=$user['role']) {	
                    case 'admin':
                        header('Location: ' . BASE_URL . 'index.php?controller=Admin&action=accueil');
                        break;
                    case 'comptable':
                        header('Location: ' . BASE_URL . 'index.php?controller=comptable&action=accueil');
                        break;
                    case 'prefet':
                        header('Location: ' . BASE_URL . 'index.php?controller=Prefet&action=accueil');
                        break;
                    case 'directeur':
                        header('Location: ' . BASE_URL . 'index.php?controller=Directeur&action=accueil');
                        break;
                    case 'directrice':
                        header('Location: ' . BASE_URL . 'index.php?controller=Directrice&action=accueil');
                        break;
                    default:
                        header('Location: ' . BASE_URL . 'index.php?controller=Auth&action=login');
                        break;
                }
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect";
                require 'views/auth/login.php';
            }
        } else {
            require 'views/auth/login.php';
        }
    }


    private function redirectUserByRole($role) {
        
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = $_POST['role'];

            $this->userModel->add($username, $email, $password, $role);
            header('Location: ' . BASE_URL . 'index.php?controller=Auth&action=login');
        } else {
            require 'views/auth/register.php';
        }
    }

    public function logout() {
        session_start();
        session_unset(); // Supprime toutes les variables de session
        session_destroy(); // Détruit la session
        header('Location: ' . BASE_URL . 'index.php?controller=Auth&action=login');
        exit();
    }
    
}
?>
