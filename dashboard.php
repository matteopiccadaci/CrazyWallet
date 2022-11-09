<?php
require_once 'operations.php';
require_once 'navbar.php';
require_once 'finance.php';
session_start();
if(!isset($_SESSION['id']))
    header("location:/index.php");
$utente=get_user($_SESSION['id']);

if (isset($_GET['ajax'])) {
    $out="";
    if($_GET['ajax']==1) {
        $ts = get_asset($_GET['asset'], 'DAILY');
        foreach ($ts as $stocks) {
            $day = array_search($stocks, $ts);
            $final[] = [
                'x' => $day,
                'y' => [$stocks['1. open'], $stocks['2. high'], $stocks['3. low'], $stocks['4. close']],
            ];
        }
        echo json_encode($final);
        exit();
    }
}
// Generazione dei valori per il grafico Candlestick
?>

<?php  $part=(get_value_allocation(get_allocation($_SESSION['id']), get_total_value($_SESSION['id'])));
foreach ($part as $asset) {
    $assets[] = $asset['asset'];
    $values[] = round($asset['valore'],2);
}
echo '<script>var stocks=[]</script>';
foreach ($assets as $asset){
    echo '<script>stocks.push(' . json_encode($asset) . ');</script>';
}
echo '<script>var values=[]</script>';
foreach ($values as $value){
    echo '<script>values.push(' . json_encode($value) . ');</script>';
}

//Generazione dei valori per il grafico a torta, in base all'allocation del portafoglio.
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
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
      <link href="CSS-JS/styleCrazyWallet14.css" rel="stylesheet">
      <script src="CSS-JS/PieChart.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  </head>
  <body>

  <!-- Top left corner-->

  <header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow" style="background: linear-gradient(to bottom left, #0066ff 23%, #66ffcc 80%); opacity: 0.8">
      <a class="navbar navbar-brand col-md-3 col-lg-2 me-0 px-2 fs-8" href="#" style="background: linear-gradient(to bottom right, #0066ff 23%, #66ffcc 80%);"><p id="logoandcustomer" >
              <button id="logobutton" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation" >
                  <span id="logobutton"> Crazy Wallet </span>
              </button></p></a>
      <?php echo('<span><i id="logoandcustomer" style="color:#00006e">&nbsp;'.$utente[0].' '.$utente[1].'</i></span>&nbsp;') ?>
  </header>

  <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
          &nbsp;
        <ul class="nav flex-column">
          <?php echo get_navbar(); ?>
        </ul>

      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <!-- Come reperibile nei docs di Apexcharts, ogni grafico deve essere compreso all'interno di un div. -->
        <div id="contenitore" class="row">

        <div class="card" id="piediv">
            <div class="card-body">
                <h3>Asset Allocation</h3>
                <div>
                    <canvas id="myChart"></canvas>
                </div>
                <script>newChart(values, stocks)</script>
            </div>
        </div>
            <div id="divisore">  </div>
            <br>

        <div class="card"  id="rendimento">
            <div class="card-body">
                <div> <h3>Rendimento di oggi</h3></div>
                <?php
                foreach(retreive_user_assets($_SESSION['id']) as $asset){
                    $final[]=[
                        'asset'=>$asset[0],
                        'quantita'=>retreive_total_quantity($_SESSION['id'], $asset[0])
                    ];
                }
                foreach ($final as $asset) {
                    $valoreNew += get_intraday_asset_total($asset['asset'], $asset['quantita']);
                } //viene calcolata l'attuale quotazione di mercato di tutti gli asset dell'utente e via via sommata per conoscere 'attuale valore dell'intero portafoglio.
                $rendimento=(($valoreNew-get_total_value($_SESSION['id']) )-1)/100; //viene calcolato il rendimento percentuale, ovvero la differenza in percentuale tra il valore attuale e il valore d'acquisto.
                if ($rendimento>=0)
                echo '
                        <br>&nbsp;<div><p><b id="percentuale"><svg xmlns="http://www.w3.org/2000/svg" id="frecce" width="70" height="70" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16" color="green">
                      <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                        </svg>'.round($rendimento,2).'%</b></p></div>';
                else
                    echo '<div><p id="percentuale"><svg xmlns="http://www.w3.org/2000/svg" id="frecce" width="70" height="70" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16" color="red">
                          <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                           </svg>'.round($rendimento,2).'%</b></p></div>';

                //La differenza qui è semplicemente se mostrare una freccia verde all'insù se si è in guadagno o una freccia rossa verso il basso se si è in perdita.

                echo '<br><br> <div><h3>Valorizzazione attuale</h3><p><b id="valore">'.round($valoreNew, 2).' $</b> </p></div>';
                ?>
            </div>

        </div>
        </div>

        <br>
        <div id="chartdiv" class="card" style="width: 100%;">
            <div class="card-body">
                <?php
                        echo ' <select id="asset"class="form-select"aria-label=".form-select-lg example" style="width: 30%;"> 
                                <option selected disabled>I tuoi asset</option>';
                        foreach (retreive_user_assets($_SESSION['id']) as $asset) {
                            echo "<option value='$asset[0]'>$asset[0]</option>";
                        }
                        echo '</select>';

                ?>

                <div id="chart">
                    <script id="script">chart(data)</script>
                </div>
            </div>
            </div>
        <br>


        <!-- Questo ajax cambia il grafico mostrato in base all'asset selezionato dall'utente (nella select saranno presenti solo quelli da lui posseduti) -->

        <script src="CSS-JS/assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="CSS-JS/dashboard.js"></script>


        <script>
            $("#asset").change(function (){
                console.log($('#asset').val());
                var asset=$('#asset').val();
                $.ajax({
                    type:"get",
                    data:{asset:asset,ajax:1},
                    success: function(response){
                        console.log(response);
                        $('#chart').empty();
                        $('#script').empty();
                        $('#script').html(chart(response));

                    },
                    cache:true,
                    dataType:"json"
                })
            });

            //Ajax per il grafico di rendimento giornaliero
        </script>
  </body>
</html>
