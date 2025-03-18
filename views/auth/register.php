
<?php
require_once 'config/config.php';
require_once 'models/UserModel.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Ajouter le champ username
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $userModel = new UserModel();
    $result = $userModel->register($username, $name, $email, $password, $role); // Ajouter username au paramètre

    if ($result) {
        $message = 'Inscription réussie ! Vous pouvez maintenant vous connecter.';
    } else {
        $message = 'Erreur lors de l\'inscription. Veuillez réessayer.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
</head>
<bodyc class="hold-transition login-page">
    <div class="login-box">
        <h2>Inscription</h2>
        <form method="POST" action="">
            <div class="form-group has-feedback">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" class="form-control id="username" name="username" required> <!-- Champ username -->
            </div>
            <div class="form-group has-feedback">
                <label for="name">Nom :</label>
                <input type="text"class="form-control id="name" name="name" required>
            </div>
            <div class="form-group has-feedback">
                <label for="email">Email :</label>
                <input type="email" class="form-control id="email" name="email" required>
            </div>
            <div class="form-group has-feedback">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control id="password" name="password" required>
            </div>
            <div class="form-group has-feedback">
                <label for="role">Rôle :</label>
                <select id="role" name="role" required>
                    <option value="admin">Administrateur</option>
                   
                    <option value="prefet">Préfet</option>
                    <option value="directeur">Directeur</option>
                    <option value="directrice">Directrice</option>
                    <option value="comptable">Comptable</option>
                </select>
            </div>
            <button  class="btn btn-primary btn-block btn-flat"type="submit">S'inscrire</button>
        </form>
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</bodyc>
</html>
