


<?php
// Connexion à la base de données
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Récupérer le nombre d'élèves inscrits
$result = $mysqli->query("SELECT COUNT(*) AS total_eleves FROM eleves");
$row = $result->fetch_assoc();
$total_eleves = $row['total_eleves'];

// Récupérer le nombre total d'élèves
$total_eleves_total = $total_eleves; // Vous pouvez ajuster cette requête selon vos besoins

// Récupérer le nombre de professeurs
$result = $mysqli->query("SELECT COUNT(*) AS total_professeurs FROM professeurs");
$row = $result->fetch_assoc();
$total_professeurs = $row['total_professeurs'];

// Récupérer le nombre de directeurs
$result = $mysqli->query("SELECT COUNT(*) AS total_directeurs FROM directeur");
$row = $result->fetch_assoc();
$total_directeurs = $row['total_directeurs'];

// Récupérer le nombre de directrices
$result = $mysqli->query("SELECT COUNT(*) AS total_directrices FROM directrice");
$row = $result->fetch_assoc();
$total_directrices = $row['total_directrices'];

// Récupérer le nombre de préfets
$result = $mysqli->query("SELECT COUNT(*) AS total_prefets FROM prefet");
$row = $result->fetch_assoc();
$total_prefets = $row['total_prefets'];

// Récupérer le nombre de comptables
$result = $mysqli->query("SELECT COUNT(*) AS total_comptables FROM comptable");
$row = $result->fetch_assoc();
$total_comptables = $row['total_comptables'];

// Récupérer le nombre total de frais de paiement
$result = $mysqli->query("SELECT SUM(amount_paid) AS total_frais FROM paiements_frais");
$row = $result->fetch_assoc();
$total_frais = $row['total_frais'];

// Fermer la connexion à la base de données
$mysqli->close();

// Vérifiez si une session est déjà active avant d'appeler session_start()
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Initialiser les clés si elles ne sont pas déjà définies
if (!isset($_SESSION['username'])) {
  $_SESSION['username'] = 'username';
}
if (!isset($_SESSION['email'])) {
  $_SESSION['email'] = ['email'];
}
if (!isset($_SESSION['role'])) {
  $_SESSION['role'] = ['role'];
}

// Récupérer les valeurs des clés
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>St sofie | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo BASE_URL; ?>index.php?controller=Admin&action=accueil" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>St</b>Henry</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Equipe de assistance</small>
                      </h4>
                      <p></p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Admin
                        <small><i class="fa fa-clock-o"></i></small>
                      </h4>
                      <p></p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                       
                        <small><i class="fa fa-clock-o"></i> </small>
                      </h4>
                      <p></p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        
                        <small><i class="fa fa-clock-o"></i> </small>
                      </h4>
                      <p></p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                       
                        <small><i class="fa fa-clock-o"></i></small>
                      </h4>
                      <p></p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#"></a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> 
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> 
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#"></a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        
                        <small class="pull-right"></small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only"></span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        
                        <small class="pull-right"></small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only"></span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        
                        <small class="pull-right"></small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only"></span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#"></a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">SKY</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                 admin
                  <small>2025</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#"></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#"></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#"></a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo BASE_URL; ?>index.php?controller=Auth&action=logout" class="btn btn-default btn-flat">Deconnexion</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>SKY</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="<?php echo BASE_URL; ?>index.php?controller=comptable&action=accueil">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo BASE_URL; ?>index.php?controller=comptable&action=accueil"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            
          </ul>
        </li>
        
        <li>
          <a href="<?php echo BASE_URL; ?>index.php?controller=comptable&action=inscris">
            <i class="fa fa-child"></i> <span>Eleves</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
          
        </li>
       
        <li>
          <a href="<?php echo BASE_URL; ?>index.php?controller=comptable&action=ajoutInscription">
            <i class="fa fa-child"></i> <span>Insciption</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
          
        </li>
        <li>
          <a href="<?php echo BASE_URL; ?>index.php?controller=comptable&action=ajoutpaiement">
            <i class="fa fa-child"></i> <span>Paiement frais</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
          
        </li>
        <li>
          <a href="<?php echo BASE_URL; ?>index.php?controller=comptable&action=paiements">
            <i class="fa fa-child"></i> <span>Eleves en ordres</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
          </a>
          
        </li>

       
           <li>
          <a href="<?php echo BASE_URL; ?>index.php?controller=comptable&action=rapportactions">
            <i class="fa fa-file"></i> <span>Rapports</span>
           
          </a>
        </li>
       
        <li class="treeview">
          <a href="#">
           </i> <span></span>
            <span class="pull-right-container">
            
            </span>
          </a>
          
        </li>
        
        
        <li><a href=""><span></span></a></li>
        <li class="header"></li>
        <li><a href="#"></i> <span></span></a></li>
        <li><a href="#"><span></span></a></li>
        <li><a href="#"> <span></span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="container">
    <h2>INSCRIPTION</h2>
    <form method="POST" action="index.php?controller=comptable&action=inscris">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Entrez le nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrez le prénom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de Naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe" class="form-select" required>
                <option value="" disabled selected>-- Sélectionnez le sexe --</option>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="section">Section :</label>
            <select id="section" name="section" class="form-select" required>
                <option value="" disabled selected>-- Sélectionnez une section --</option>
                <option value="maternelle">Maternelle</option>
                <option value="primaire">Primaire</option>
                <option value="secondaire">Secondaire</option>
            </select>
        </div>
        <div class="form-group">
            <label for="option">Option :</label>
            <input type="text" id="option" name="option" placeholder="Entrez l'option (si applicable)" class="form-control">
        </div>
        <div class="form-group">
            <label for="classes">Classe :</label>
            <select id="classe_id" name="classe_id" class="form-select" required>
                <option value="classe_id" disabled selected>-- Sélectionnez une classe --</option>
                <?php foreach ($classes as $classe): ?>
    <option value="<?php echo ($classe['nom']); ?>">
        
    </option>
<?php endforeach; ?>

            </select>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" placeholder="Entrez l'adresse" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact :</label>
            <input type="text" id="contact" name="contact" placeholder="Entrez le numéro de contact" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="parents">Parent :</label>
            <select name="parent_id" id="parent_id" class="form-select" required>
                <option value="parent_id" disabled selected>-- Sélectionnez un parent --</option>
                <?php foreach ($parents as $parent): ?>
                    <option value="<?php echo ($parent['id']); ?>">
                        <?php echo  ($parent['id']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="frais_status">Statut des frais :</label>
            <select id="frais_status" name="frais_status" class="form-select" required>
                <option value="" disabled selected>-- Sélectionnez le statut des frais --</option>
                <option value="payé">Payé</option>
                <option value="non payé">Non payé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<!-- ./wrapper -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane" id="control-sidebar-home-tab">
      <h3 class="control-sidebar-heading">Recent Activity</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

              <p>Will be 23 on April 24th</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-user bg-yellow"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

              <p>New phone +1(800)555-1234</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

              <p>nora@example.com</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-file-code-o bg-green"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

              <p>Execution time 5 seconds</p>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

      <h3 class="control-sidebar-heading">Tasks Progress</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Custom Template Design
              <span class="label label-danger pull-right">70%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Update Resume
              <span class="label label-success pull-right">95%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Laravel Integration
              <span class="label label-warning pull-right">50%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Back End Framework
              <span class="label label-primary pull-right">68%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

    </div>
    <!-- /.tab-pane -->
    <!-- Stats tab content -->
    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
    <!-- /.tab-pane -->
    <!-- Settings tab content -->
    <div class="tab-pane" id="control-sidebar-settings-tab">
      <form method="post">
        <h3 class="control-sidebar-heading">General Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Report panel usage
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Some information about this general settings option
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Other sets of options are available
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Allow the user to show his name in blog posts
          </p>
        </div>
        <!-- /.form-group -->

        <h3 class="control-sidebar-heading">Chat Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Show me as online
            <input type="checkbox" class="pull-right" checked>
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Turn off notifications
            <input type="checkbox" class="pull-right">
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Delete chat history
            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
          </label>
        </div>
        <!-- /.form-group -->
      </form>
    </div>
    <!-- /.tab-pane -->
  </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="../../bower_components/chart.js/Chart.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
$(function () {
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //--------------
  //- AREA CHART -
  //--------------

  // Get context with jQuery - using jQuery's .get() method.
  var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
  // This will get the first returned node in the jQuery collection.
  var areaChart       = new Chart(areaChartCanvas)

  var areaChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label               : 'Electronics',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [65, 59, 80, 81, 56, 55, 40]
      },
      {
        label               : 'Digital Goods',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 90]
      }
    ]
  }

  var areaChartOptions = {
    //Boolean - If we should show the scale at all
    showScale               : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : false,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - Whether the line is curved between points
    bezierCurve             : true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension      : 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot                : false,
    //Number - Radius of each point dot in pixels
    pointDotRadius          : 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth     : 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke           : true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth      : 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill             : true,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  }

  //Create the line chart
  areaChart.Line(areaChartData, areaChartOptions)

  //-------------
  //- LINE CHART -
  //--------------
  var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
  var lineChart                = new Chart(lineChartCanvas)
  var lineChartOptions         = areaChartOptions
  lineChartOptions.datasetFill = false
  lineChart.Line(areaChartData, lineChartOptions)

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieChart       = new Chart(pieChartCanvas)
  var PieData        = [
    {
      value    : 700,
      color    : '#f56954',
      highlight: '#f56954',
      label    : 'Chrome'
    },
    {
      value    : 500,
      color    : '#00a65a',
      highlight: '#00a65a',
      label    : 'IE'
    },
    {
      value    : 400,
      color    : '#f39c12',
      highlight: '#f39c12',
      label    : 'FireFox'
    },
    {
      value    : 600,
      color    : '#00c0ef',
      highlight: '#00c0ef',
      label    : 'Safari'
    },
    {
      value    : 300,
      color    : '#3c8dbc',
      highlight: '#3c8dbc',
      label    : 'Opera'
    },
    {
      value    : 100,
      color    : '#d2d6de',
      highlight: '#d2d6de',
      label    : 'Navigator'
    }
  ]
  var pieOptions     = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    //String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    //Number - The width of each segment stroke
    segmentStrokeWidth   : 2,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps       : 100,
    //String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : true,
    //String - A legend template
    legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions)

  //-------------
  //- BAR CHART -
  //-------------
  var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
  var barChart                         = new Chart(barChartCanvas)
  var barChartData                     = areaChartData
  barChartData.datasets[1].fillColor   = '#00a65a'
  barChartData.datasets[1].strokeColor = '#00a65a'
  barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  barChart.Bar(barChartData, barChartOptions)
})
</script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
