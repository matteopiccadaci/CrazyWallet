<?php
require_once 'finance.php';
require_once 'navbar.php';
session_start();
if(!isset($_SESSION['id']))
    header("location:/index.php");
if(isset($_SESSION['id']))
    $utente = get_user($_SESSION['id']);
if(retreive_quantity($_SESSION['id'])<0 || retreive_quantity($_SESSION['id'])==null)
    header("location:/index.php");

//Se l'utente accede senza aver effettuato il login o senza che possegga alcun asset, viene reindirizzato alla pagina di login

$id_f=$_SESSION['id']*678602;
/*L'id verrò poi inviato tramite una chiamata GET per identificare l'utente.
Per evitare di inviare l'id usato realmente nel database, viene moltiplicato per un numero casuale,
che tuttavia non viene generato volta per volta.*/


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
        function esporta() {
            var data={};
            data.id=document.getElementById("id_utente").innerText;
            data.api_key=document.getElementById("api_key").innerText;
            var req = new XMLHttpRequest();
            req.onload = function(){
                var filename= 'Wallet di '+'<?php echo $utente[0]. " "; echo $utente[1];?>'+'.json';
                const file= new File([req.responseText], filename, {type: "text/json"});
                const link = document.createElement('a')
                const url = URL.createObjectURL(file)

                link.href = url
                link.download = file.name
                document.body.appendChild(link)
                link.click()

                document.body.removeChild(link)
                window.URL.revokeObjectURL(url) //La parte del download è stata presa da https://javascript.plainenglish.io/javascript-create-file-c36f8bccb3be
            };
            req.open("GET", "operationsapi.php/export?id="+data.id+"&api_key="+data.api_key, true);
            req.send();
        }
    /*Questa API è stata creata per permettere all'utente di esportare i dati del suo portafoglio in un file json da scaricare
      e, eventualmente, metterli a disposizione per una futura applicazione esterna.
       */
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
                <h1 class="h2">Esporta il tuo wallet</h1>
            </div>

            <!-- Come reperibile nei docs di Apexcharts, ogni grafico deve essere compreso all'interno di un div. -->

            <div id="contenitore" class="card" >
                    <div class="card-body">
                        <h3>Esporta</h3>
                        <br>
                        <div>
                            <h5><b >Il tuo ID</b>: <h5 id="id_utente"><?php echo $id_f; ?></h5></h5>
                            <br>
                            <h5><b>La tua API KEY</b>: <h5 id="api_key"><?php $ak= get_api_key($_SESSION['id']); echo $ak; ?></h5></h5>
                            <br>
                            <h5><b>Per utilizzare il tuo portafoglio in altri servizi</b>: <?php $link= "https://crazywallet.altervista.org/operationsapi.php/export?id=".$id_f."&api_key=".$ak ;echo "<h5><a href='".$link."'>".$link."</a></h5>";?></>
                        </div>
                        <br>
                        <br>
                        <button type="button" class="btn btn-outline-dark" id="dlbutton" onclick="esporta()">Scarica in formato JSON</button>
                </div>

            </div>
        </main>
    </div>
</div>
        <script src="CSS-JS/assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="CSS-JS/dashboard.js"></script>
</body>
</html>