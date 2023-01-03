<?php
require_once 'finance.php';
require_once 'navbar.php';
session_start();
if(!isset($_SESSION['id']))
    header("location:/index.php");
if(isset($_SESSION['id']))
    $utente = get_user($_SESSION['id']);
if(!(retreive_quantity($_SESSION['id'])<0 || retreive_quantity($_SESSION['id'])==null))
    header("location:/index.php");

//Se l'utente accede senza aver effettuato il login o se già possiede degli asset, viene reindirizzato alla pagina di login

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crazy Wallet</title>
    <link href="CSS-JS/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="CSS-JS/dashboardCrazy.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="CSS-JS/chart.js"></script>
    <script type="text/javascript" src="CSS-JS/table3.js"></script>
    <link href="CSS-JS/styleCrazyWallet14.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <script>
        function importa() {
            var file = document.getElementById("wallet-file").files[0];
            var reader= new FileReader();
            reader.readAsText(file);
            reader.onload = function() {
                var data= reader.result;
                data=data.slice(0, -1);
                data=data+',"id":'+'"<?php echo $_SESSION['id'];  ?>' +'"}';//aggiunge l'id dell'utente, per poter realizzare l'operazione di caricamento nel wallet
                var req = new XMLHttpRequest();
                req.onload = function(){
                    document.getElementById("risposta").removeAttribute("hidden");
                    document.getElementById("risposta").innerHTML = req.responseText;
                };
                req.open("POST", "operationsapi.php/import", true);
                req.send(data);

            };
        }
        //Questa API è stata creata per permettere all'utente di importare i dati nel suo portafoglio, a partire da un file JSON
    </script>
</head>
<body>

<!-- Top left corner-->
<header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow" style="background: linear-gradient(to bottom left, #0066ff 23%, #66ffcc 80%); opacity: 0.8">
    <a class="navbar navbar-brand col-md-3 col-lg-2 me-0 px-2 fs-8" href="#" style="background: linear-gradient(to bottom right, #0066ff 23%, #66ffcc 80%);"><p id="logoandcustomer" >
            <button id="logobutton" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation" >
                <span id="logobutton"> Crazy Wallet </span>
            </button></p></a>
    <span><i id="logoandcustomer" style="color:#00006e">&nbsp;<?php if (isset($_SESSION['id'])) echo $utente[0]." ".$utente[1]; else echo "Benvenuto";?></i></span>&nbsp;
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                <ul class="nav flex-column">
                    &nbsp;
                    <?php if (isset($_SESSION['id'])) {
                        echo get_navbar($_SESSION['id']); //Menù di navigazione
                    }
                    else echo ' <li class="nav-item">
                <a id="nav_link" class="nav-link active" aria-current="page" href="index.php">
              <span data-feather="user" class="align-text-bottom"></span>
              Login
            </a>
            </li>';
                    ?>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Importa il tuo wallet</h1>
            </div>

            <div id="contenitore" class="card">
                <div class="card-body" >
                    <h3>Importa</h3>
                    <br>
                    <div>
                    <input id="wallet-file" type="file" class="form-control" style="width: 50%" accept=".json">
                     <br>
                        <button type="button" class="btn btn-outline-dark" style="width: 50%" onclick="importa()">Importa il tuo wallet</button>
                </div>
                    <br>
                    <h4 id="risposta" hidden></h4>
            </div>
            </div>
</main>
</div>
</div>
            <script src="CSS-JS/assets/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="CSS-JS/dashboard.js"></script>
</body>
</html>