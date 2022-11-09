<?php
require_once 'operations.php';
require_once  'finance.php';
require_once 'navbar.php';
session_start();
if(!isset($_SESSION['id']))
    header("location:/index.php");
$utente=get_user($_SESSION['id']);
?> <!-- verifica dell'utente -->

<?php
$JSON=file_get_contents("php/s&p500.json");
$data = json_decode($JSON);
?>

<?php
if(isset($_GET['ajax'])){
    if($_GET['ajax']==1){
    if (isset($_GET['asset']))
    echo get_intraday_asset_price($_GET['asset']);
    }
    if($_GET['ajax']==2){
        if(isset($_GET['quantita']))
            echo get_intraday_asset_total($_GET['asset'], $_GET['quantita']);
        }
    exit();
    }
/* Come valore di acquisto, viene scelto quello risalente a un minuto fa.
Vengono fatti controlli per evitare di mostrare messaggi di errore come, ad esempio, se si seleziona un asset non più presente
sul mercato e se vengono letti valori non legali se si "gioca" nella selezione di quantità e asset.
 */
?>
<?php
if(isset($_POST['invia'])){
    echo add_to_wallet($_POST['asset'], $_POST['quantita'], $_POST['wallet'], $_SESSION['id'], get_intraday_asset_price($_POST['asset']), get_intraday_asset_total($_POST['asset'], $_POST['quantita']));
}
?>

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
  <link href="CSS-JS/styleCrazyWallet14.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="CSS-JS/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="CSS-JS/dist/js/adminlte.min.js"></script>


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

<script>
  let quantita = document.getElementById('quantita');
  let timeout = null;
  quantita.addEventListener('keyup', function (e) {
      clearTimeout(timeout);
      timeout = setTimeout(function () {
      }, 1000);
  });

  let asset = document.getElementById('asset');
  let timeout2 = null;
  asset.addEventListener('keyup', function (e) {
      clearTimeout(timeout2);
      timeout2 = setTimeout(function () {
      }, 1000);
  });
</script>

<div class="container-fluid">
  <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3 sidebar-sticky">
              <ul class="nav flex-column">
                  &nbsp;
                  <li class="nav-item">
                      <?php
                      echo get_navbar();
                      ?>
              </ul>

          </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h3>Inserisci nel portafoglio una nuova posizione</h3>
          </div>
          <form method="post">
              <div class="form-group">
                  <label for="asset">Asset</label>
                  <select name='asset' id="asset" class="form-control form-control-lg">
                      <option selected disabled>Seleziona l'asset</option>
                      <?php
                      foreach($data as $asset){
                          echo '<option value='.$asset-> Symbol.'>'.$asset -> Name.' - '.$asset -> Symbol .'</option>';
                      }
                      ?> <!-- Si è scelto di mostrare solamente gli asset presenti nello S&P 500, poiché mostrare l'intera lista degli asset presenti sul mercato risultava troppo oneroso. Il tipo restituito dal json_decode è di tipo stdClass. In questo caso si comporta come un array associativo -->
                  </select>
              </div>
              <br>
              <div class="form-group">
                  <label for="quantita">Quantità</label>
                  <input type="text" class="form-control" name='quantita' id="quantita" placeholder="Inserisci il numero di azioni" min="1">
              </div>
              <br>
              <div class="form-group">
                  <label for="prezzo">Prezzo di acquisto</label>
                  <div class="col-md-12 mt-1 border border-dark" style="border-radius: 10px; height: 38px;"> <p  id="stockbox"><b id="prezzo"></b></p>
              </div>
                  <br>
              <div class="form-group">
                  <label for="wallet">Wallet</label>
                  <input type="password" class="form-control" name="wallet" id="wallet" placeholder="Inserisci il codice del tuo wallet" maxlenght="20">
              </div>
                  <br>
              <div class="form-group">
                  <label for="prezzo" class="form-label m-1">Valore finale</label>
                  <div class="col-md-12 mt-1 border border-dark" style="border-radius: 10px; height: 38px; text-align: left"><p style="padding-top: 0.6%"><b id="valore" style="padding-left: 1%; font-size: 15px"></b></p>
              </div>
                  <br> <br>
                  <input type="text" id="invia" name="invia" hidden value="1">
              <button name="invia" type="submit" class="btn btn-primary" style="width: 100%; text-align: center">Invia</button>
          </form>




          <!-- Come reperibile nei docs di Apexcharts, ogni grafico deve essere compreso all'interno di un div. -->

          <script src="CSS-JS/assets/dist/js/bootstrap.bundle.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="CSS-JS/dashboard.js"></script>
      </main>
  </div>
</div>


<script>
$("#asset").change(function (){
  var asset=$('#asset option:selected').attr("value"),
      quantita=$('#quantita').val();
  $.ajax({
  type:"get",
  data:{asset:asset, quantita:quantita, ajax:1},
      success: function(response){
          $('#quantita').empty();
          $('#valore').empty();
          $('#prezzo').html(response);

  }
  })
});

$("#quantita").change(function(){
  var asset =$('#asset').val(),
      quantita=$('#quantita').val();
  $.ajax({
      type:'get',
      data:{quantita:quantita,asset:asset, ajax:2},
      success: function(response) {
          $('#valore').html(response);
      }
  })
});
/*In questi ajax viene via via modificato il prezzo dell'asset a sè e il prezzo totale di acquisto nel caso si acquisti più di un'azione. */
</script>

</body>
</html>