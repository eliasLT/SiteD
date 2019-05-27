<?php
    session_start();
//    var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../static/images/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../static/images/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Tableau pour DomoCasa
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../static/css/dashboard/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="../static/css/dashboard/index.css" rel="stylesheet" />



</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a href="./dashboard.php" class="simple-text logo-normal">
                DomoCasa
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item active  ">
                    <a class="nav-link" href="./dashboard.php">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./user.php">
                        <i class="material-icons">person</i>
                        <p>Données personnelles</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./history.php">
                        <i class="material-icons">content_paste</i>
                        <p>Historique</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./bills.html">
                        <i class="material-icons">library_books</i>
                        <p>Factures</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./controle.html">
                        <i class="material-icons">bubble_chart</i>
                        <p>Contrôle</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->


        <div class="content">
            <div class="container-fluid">
                <div id="consom-hebdo" class="row">
                    <div class="col-lg-12 col-md-12 col-sm-9">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <p class="card-category">Consommation hébdomadaire</p>
                                <h3 class="card-title">49/50
                                    <small>GB</small>
                                </h3>
                            </div>
                            <div class="card-body graph-conso">
                                <canvas id="barChart"></canvas>

                            </div>
                        </div>
                    </div>
                </div>

                <div  class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div id="jour1" class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <h3 class="card-title">Lundi</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div id="jour2" class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <h3 class="card-title">Mardi</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div id="jour3" class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <h3 class="card-title">Mercredi</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div id="jour4" class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <h3 class="card-title">Jeudi</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div id="jour5" class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <h3 class="card-title">Vendredi</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div id="jour6" class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <h3 class="card-title">Samedi</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div id="jour7" class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <h3 class="card-title">Dimanche</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            //bar


        </script>

        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright float-right">
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, made with <i class="material-icons">favorite</i> by
                    <a href="https://github.com/eliasLT" target="_blank">Elias</a> for a better web.
                </div>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src="../static/js/dashboard/core/jquery.min.js"></script>
<script src="../static/js/dashboard/core/popper.min.js"></script>
<script src="../static/js/dashboard/core/bootstrap-material-design.min.js"></script>
<script src="../static/js/dashboard/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="../static/js/dashboard/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="../static/js/dashboard/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="../static/js/dashboard/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="../static/js/dashboard/plugins/jquery.bootstrap-wizard.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="../static/js/dashboard/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="../static/js/dashboard/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="../static/js/dashboard/plugins/jquery.dataTables.min.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="../static/js/dashboard/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="../static/js/dashboard/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="../static/js/dashboard/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="../static/js/dashboard/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="../static/js/dashboard/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="../static/js/dashboard/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="../static/js/dashboard/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../static/js/dashboard/plugins/bootstrap-notify.js"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.1/js/mdb.min.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../static/js/dashboard/material-dashboard.js?v=2.1.1" type="text/javascript"></script>













<script src="../static/js/dashboard/index.js" type="text/javascript"></script>
</body>

</html>
