
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
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                
                // Redirection en fonction du rôle de l'utilisateur
                $this->redirectUserByRole($user['role']);
                exit();
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect";
                require 'views/auth/login.php';
            }
        } else {
            require 'views/auth/login.php';
        }
    }

    private function redirectUserByRole($role) {
        switch ($role) {
            case 'admin':
                header('Location: ' . BASE_URL . 'index.php?controller=Admin&action=accueil');
                break;
            case 'comptable':
                header('Location: ' . BASE_URL . 'index.php?controller=Comptable&action=accueil');
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
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = $_POST['role'];

            $this->userModel->add($username, $password, $role);
            header('Location: ' . BASE_URL . 'index.php?controller=Auth&action=login');
        } else {
            require 'views/auth/register.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . 'index.php?controller=Auth&action=login');
    }
}
?>
