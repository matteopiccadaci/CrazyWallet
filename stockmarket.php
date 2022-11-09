<?php
require_once 'operations.php';
require_once 'finance.php';
require_once 'navbar.php';
session_start();
if(isset($_SESSION['id'])) {
    $utente = get_user($_SESSION['id']);
}
      if(isset ($_GET['ajax'])){
        $out="";

            if($_GET['timeframe']==1){
                $ts= get_asset($_GET['asset'], 'DAILY');
            }

            else if($_GET['timeframe']==2){
                $ts=get_asset($_GET['asset'], 'WEEKLY');
                    }

            else if($_GET['timeframe']==3){
                $ts=get_asset($_GET['asset'], 'MONTHLY');
         }
          if($_GET['ajax']==1 || $_GET['ajax']==2) {
              foreach ($ts as $stocks) {
                  $day = array_search($stocks, $ts);
                  $final[] = [
                      'x' => $day,
                      'y' => [$stocks['1. open'], $stocks['2. high'], $stocks['3. low'], $stocks['4. close']],
                  ];

              }
              echo json_encode($final);
          }
        exit();
        }# A prescindere da quale opzione (asset o timeframe) venga cambiato, l'operazione da fare è la stessa, quindi si può riutilizzare lo stesso codice.
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
                    echo get_navbar(); //Menù di navigazione
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
        <h1 id="asset_dash" class="h2">Mercato</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        <!-- popolamento select con le azioni e gli ETF -->

            <input type="text" id="asset" class="form-control" placeholder="Azioni o ETF" style="width: 52%; text-transform:uppercase">
            <select id="timeframe"class="form-select"aria-label=".form-select-lg example" style="width: 48%">
            <option selected disabled>Timeframe</option>
            <option value="1">Giornaliero</option>
            <option value="2">Settimanale</option>
            <option value="3">Mensile</option>
            </select>

        </div>
      </div>

      <div id="chart">
      <script id="script">chart(data)</script>
        </div>
        <br>
        <div>
        <table id="table" class="table table-striped table-sm" hidden>
            <thead>
            <tr>
                <th>Data</th>
                <th>Apertura</th>
                <th>Massimo</th>
                <th>Minimo</th>
                <th>Chiusura</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $i<6; $i++){
                echo "<tr>";
                echo "<td id='tday".$i."'></td>";
                echo "<td id='topen".$i."'></td>";
                echo "<td id='thigh".$i."'></td>";
                echo "<td id='tlow".$i."'></td>";
                echo "<td id='tclose".$i."'></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>



      <!-- Come reperibile nei docs di Apexcharts, ogni grafico deve essere compreso all'interno di un div. -->
    
    <script src="CSS-JS/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="CSS-JS/dashboard.js"></script>

    <script>

        $(document).on('change', '#timeframe', function (){
            var timeframe=$('#timeframe option:selected').attr("value"),
                asset=$('#asset').val();
            $.ajax({
                    type:"get",
                    data:{timeframe:timeframe,asset:asset,ajax:1},
                    success: function(response){
                        console.log(response);
                        $('#asset_dash').attr('style', 'text-transform:uppercase');
                        $('#asset_dash').html(asset);
                        $('#chart').empty();
                        $('#script').empty();
                        $('#table').removeAttr('hidden');
                        for (var i=0; i<6;i++) {
                            $('#tday'+i).html(response[i]['x']);
                            $('#topen'+i).html(response[i]['y'][0]);
                            $('#thigh'+i).html(response[i]['y'][1]);
                            $('#tlow'+i).html(response[i]['y'][2]);
                            $('#tclose'+i).html(response[i]['y'][3]);
                        }
                        $('#script').html(chart(response));


                    },
                    cache:true,
                    dataType:"json",
            }
            )
        });

        /* In questo ajax (realizzato con la sintassi di jquery) si valuta il cambio del timeframe (giornaliero, settimanale o mensile). In particolare, tramite la funzione in php all'inizio del file, si genera un array che, una volta "Tradotto" in JSON, avrà per ogni valore nelle ascisse la data e nelle
        ordinate un array con i valori di apertura, massimo, minimo e chiusura. Questo array viene interamente passato alla funzione chart, che si occupa di creare il grafico, mentre si prendono le prime 7 date per popolare la tabella.*/



        $("#asset").change(function (){
            console.log($('#asset').val())
            var timeframe=$('#timeframe option:selected').attr("value"),
                asset=$('#asset').val();
            $.ajax({
                    type:"get",
                    data:{timeframe:timeframe,asset:asset,ajax:2},
                    success: function(response){
                        $('#asset_dash').attr('style', 'text-transform:uppercase');
                        $('#asset_dash').html(asset);
                        $('#chart').empty();
                        $('#script').empty();
                        $('#script').html(chart(response));


                    },
                    cache:true,
                    dataType:"json",
                    })
            });
        // In questo ajax invece si valuta il cambio dell'asset.


</script>
</body>
</html>