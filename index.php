<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.98.0">
    <title>Mitems</title> 
    <link rel="icon" type="image/x-icon" href="View/Assets/logo/favicon.ico">
    <link href="View/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="View/css/components/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <?php
        foreach (glob("Model/*.php") as $models)
        {
            include_once $models;
        }
        foreach (glob("Controller/*.php") as $controllers)
        {
            include_once $controllers;
        }
    ?>
    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="?view=default">Mitems</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="View/php/helper/helper_logout.php">Sign out</a>
        </div>
    </div>
    </header>

    <div class="container-fluid">
    <div class="row">

        <?php
        session_start();
            // Navbar einbinden
            include 'View/php/nav.phtml';

        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php

        if(!isset($_SESSION['auth'])) {
            header("Location: http://localhost/mitems/view/php/login.php");
            exit;
        }else{
            if($_SESSION['auth'] == true) {
                $includePath = 'View/php/default.phtml';           

                if(isset($_GET['view']) && $_GET['view'] !== '') {
                    $includePath = 'View/php/'.$_GET['view'].'.phtml';
                }
                if(file_exists($includePath)) {
                    include $includePath;
                }
            }
   
        }
        ?>
    
           
       
        </main>
    </div>
    </div>


    <script src="View/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="View/js/tooltip.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="View/js/dashboard.js"></script>
  </body>
</html>
