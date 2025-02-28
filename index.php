
<?php


// Inclusion des fichiers de configuration
require 'config/config.php';
require 'config/database.php';

// Vérification des paramètres de l'URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Inclusion du contrôleur approprié
$controllerFile = 'controllers/' . $controller . '.php';
if (file_exists($controllerFile)) {
    require $controllerFile;
    $controllerClass = new $controller();
    if (method_exists($controllerClass, $action)) {
        $controllerClass->$action();
    } else {
        echo "L'action demandée n'existe pas.";
    }
} else {
    echo "Le contrôleur demandé n'existe pas.";
}
?>

