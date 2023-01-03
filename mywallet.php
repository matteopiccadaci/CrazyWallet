<?php
require_once 'navbar.php';
require_once 'finance.php';
session_start();
if(!isset($_SESSION['id']))
    header("location:/index.php");
$utente=get_user($_SESSION['id']);
if (retreive_quantity($_SESSION['id'])<0 || retreive_quantity($_SESSION['id'])==null)
    header("location:/dashboard.php");

/*Questa pagina è accessibile solo se l'utente è loggato e ha almeno un asset nel suo portafoglio.
Se viene visitata la pagina inserendo l'URL, in questi due casi si viene reindirizzati alla pagina di login*/

if (isset($_GET['ajax'])) {
    $out="";
    if($_GET['ajax']==1) {
        $final=[
            'valoreold' => round(get_value_single_asset($_SESSION['id'], $_GET['asset']),2),
            'valorenew'=> round(get_intraday_asset_total($_GET['asset'], retreive_total_quantity($_SESSION['id'], $_GET['asset'])),2),
            'valorediff' => round((get_intraday_asset_total($_GET['asset'], retreive_total_quantity($_SESSION['id'], $_GET['asset']))-round(get_value_single_asset($_SESSION['id'], $_GET['asset']),2)),2)
        ];
    }
    echo json_encode($final);
    exit();
}
// Vengono generati i valori da passare alla riassunto del portafoglio.
?>

<?php
$part=(get_value_allocation(get_allocation($_SESSION['id']), get_total_value($_SESSION['id'])));
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
      <title>Il tuo Wallet</title>
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
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">

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
          <?php echo get_navbar($_SESSION['id']); ?>
        </ul>

      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Il mio Portafoglio</h1>
      </div>

      <!-- Come reperibile nei docs di Apexcharts, ogni grafico deve essere compreso all'interno di un div. -->
        <div id="contenitore" class="row">
        <div class="card" id="piediv" style="margin-top: 1%">
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

        <div class="card" id="rendimento" style="margin-top: 1%">
            <div class="card-body">
            <div  class="table-responsive">
                <table  id="table" class="table table-striped table-sm" style="text-align: center">
                    <tr>
                        <th scope="col">Simbolo</th>
                        <th scope="col">Quantita</th>
                        <th scope="col">Open</th>
                        <th scope="col">High</th>
                        <th scope="col">Low</th>
                        <th scope="col">Close</th>
                        <th scope="col">Rendimento</th>
                    </tr>
                    <?php
                    foreach(retreive_user_assets($_SESSION['id']) as $asset) {
                        $data = (get_asset_today($asset[0]));
                        $quantita = retreive_total_quantity($_SESSION['id'], $asset[0]);
                        if ($quantita > 0) {
                            $rendimento = ((get_intraday_asset_total($asset[0], $quantita) - (get_value_single_asset($_SESSION['id'], $asset[0]))) - 1) / 100; //si prende il valore di mercato attuale (asset*quanità) e si sottrae la somma dei movimenti per quell'asset (già presente nel db).
                            echo '<tr>';
                            echo '<td>' . $asset[0] . '</td>';
                            echo '<td>' . retreive_total_quantity($_SESSION['id'], $asset[0]) . '</td>';
                            echo '<td>' . round($data['1. open'], 2) . '</td>';
                            echo '<td>' . round($data['2. high'], 2) . '</td>';
                            echo '<td>' . round($data['3. low'], 2) . '</td>';
                            echo '<td>' . round($data['4. close'], 2) . '</td>';
                            echo '<td>' . round($rendimento, 2) . '%</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                    </table>
                <br>
                <?php
                echo ' <select id="asset"class="form-select"aria-label=".form-select-lg example" style="width: 50%;"> 
                                <option selected disabled>I tuoi asset</option>';
                foreach (retreive_user_assets($_SESSION['id']) as $asset) {
                    echo "<option value='$asset[0]'>$asset[0]</option>";
                }
                echo '</select>';
                echo '<br> <p><h6 id="valoreoldint" hidden>Valore di acquisto</h6><p id="valoreold"></p></p> <span></span> <p><h6 id="valorenewint" hidden>Valore attuale</h6><p id="valorenew"></p></p> <span></span> <p><h6 id="valorediffint" hidden>Variazione</h6><p id="valorediff"></p></p>';
                ?>
                <!-- In questa sezione, si crea la tabella con tutti i price point più aggiornati solamente per gli asset facenti parte del portafoglio (viene infatti controllato che la quantità totale dell'asset sia superiore a 0. Al contempo vengono presi sia valore d'acquisto, sia valore attuale per poi mostrarne la differenza netta. -->
            </div>
        </div>
        <br>
        </div>



        <script src="CSS-JS/assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="CSS-JS/dashboard.js"></script>

            <script>
                $("#asset").change(function (){
                    var asset=$('#asset').val();
                    console.log(asset);
                    $.ajax({
                        type:"get",
                        data:{asset:asset,ajax:1},
                        success: function(response){
                            console.log(response);
                            $('#valoreoldint').removeAttr('hidden');
                            $('#valorenewint').removeAttr('hidden');
                            $('#valorediffint').removeAttr('hidden');
                            $('#valoreold').html(response['valoreold']);
                            $('#valorenew').html(response['valorenew']);
                            $('#valorediff').html(response['valorediff']+' $');

                        },
                        cache:true,
                        dataType:"json"
                    })
                });
                /* In questo ajax si mostra la quotazione d'acquisto, quella attuale e la variazione di ogni asset preso singolarmente */
            </script>


  </body>
</html>
