<?php
require_once ("php/config.php");
session_start();
$id=$_SESSION['id'];
$querynome="SELECT nome, cognome
FROM Utenti
WHERE id_utente='$id'";
$res=$connect_db->query($querynome);
$arr=mysqli_fetch_array($res, MYSQLI_ASSOC);
$nome=$arr['nome'];
$cognome=$arr['cognome'];
?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Crazy Wallet</title>
<link href="CSS-JS/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
   <link href="CSS-JS/dashboardCrazy.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <script src="CSS-JS/chart.js"></script>
   <link href="CSS-JS/styleCrazyWallet2.css" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>

  <!-- Top left corner-->

  <header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow" style="background: linear-gradient(to bottom left, #0066ff 23%, #66ffcc 80%); opacity: 0.8">
      <a class="navbar navbar-brand col-md-3 col-lg-2 me-0 px-2 fs-8" href="#" style="background: linear-gradient(to bottom right, #0066ff 23%, #66ffcc 80%);"><p id="logoandcustomer" >
              <button id="logobutton" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation" >
                  <span id="logobutton"> Crazy Wallet </span>
              </button></p></a>
      <?php echo('<span><i id="logoandcustomer" style="color:#00006e">&nbsp;'.$nome.' '.$cognome.'</i></span>&nbsp;') ?>
  </header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
          &nbsp;
        <ul class="nav flex-column">
          <li class="nav-item">
            <a id="nav_link" class="nav-link active" aria-current="page" href="#">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a id="nav_link" class="nav-link" href="#">
              <span data-feather="file" class="align-text-bottom"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a id="nav_link" class="nav-link" href="#">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a id="nav_link" class="nav-link" href="#">
              <span data-feather="users" class="align-text-bottom"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a id="nav_link" class="nav-link" href="#">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a id="nav_link" class="nav-link" href="#">
              <span data-feather="layers" class="align-text-bottom"></span>
              Integrations
            </a>
          </li>
        </ul>

      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <?php
      $json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_MONTHLY&symbol=SHOP.TRT&apikey=Z6AFRTAJ96TUCC02');

      $data = json_decode($json,true);
      unset($data['Meta Data']);
      $ts=$data['Monthly Time Series'];
      foreach ($ts as $stocks){
        $day= array_search($stocks,$ts);
        $final[]=[
          'x'=>$day,
          'y'=>[$stocks['1. open'], $stocks['2. high'], $stocks['3. low'], $stocks['4. close']],
        ];
        }
        echo '<script>var data=[]</script>';
        foreach ($final as $stock){
          echo '<script>data.push('.json_encode($stock).');</script>';
        }
      ?>

      <!-- Come reperibile nei docs di Apexcharts, ogni grafico deve essere compreso all'interno di un div. -->


      <div id="chart"></div>
        <script>chart(data);</script>
      
      <h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Header</th>
            <th scope="col">Header</th>
            <th scope="col">Header</th>
            <th scope="col">Header</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><?php $final[0]['open']?></td>
            <td>random</td>
            <td>data</td>
            <td>placeholder</td>
            <td>text</td>
          </tr>
          <tr>
            <td>1,002</td>
            <td>placeholder</td>
            <td>irrelevant</td>
            <td>visual</td>
            <td>layout</td>
          </tr>
          <tr>
            <td>1,003</td>
            <td>data</td>
            <td>rich</td>
            <td>dashboard</td>
            <td>tabular</td>
          </tr>
          <tr>
            <td>1,003</td>
            <td>information</td>
            <td>placeholder</td>
            <td>illustrative</td>
            <td>data</td>
          </tr>
          <tr>
            <td>1,004</td>
            <td>text</td>
            <td>random</td>
            <td>layout</td>
            <td>dashboard</td>
          </tr>
          <tr>
            <td>1,005</td>
            <td>dashboard</td>
            <td>irrelevant</td>
            <td>text</td>
            <td>placeholder</td>
          </tr>
          <tr>
            <td>1,006</td>
            <td>dashboard</td>
            <td>illustrative</td>
            <td>rich</td>
            <td>data</td>
          </tr>
          <tr>
            <td>1,007</td>
            <td>placeholder</td>
            <td>tabular</td>
            <td>information</td>
            <td>irrelevant</td>
          </tr>
          <tr>
            <td>1,008</td>
            <td>random</td>
            <td>data</td>
            <td>placeholder</td>
            <td>text</td>
          </tr>
          <tr>
            <td>1,009</td>
            <td>placeholder</td>
            <td>irrelevant</td>
            <td>visual</td>
            <td>layout</td>
          </tr>
          <tr>
            <td>1,010</td>
            <td>data</td>
            <td>rich</td>
            <td>dashboard</td>
            <td>tabular</td>
          </tr>
          <tr>
            <td>1,011</td>
            <td>information</td>
            <td>placeholder</td>
            <td>illustrative</td>
            <td>data</td>
          </tr>
          <tr>
            <td>1,012</td>
            <td>text</td>
            <td>placeholder</td>
            <td>layout</td>
            <td>dashboard</td>
          </tr>
          <tr>
            <td>1,013</td>
            <td>dashboard</td>
            <td>irrelevant</td>
            <td>text</td>
            <td>visual</td>
          </tr>
          <tr>
            <td>1,014</td>
            <td>dashboard</td>
            <td>illustrative</td>
            <td>rich</td>
            <td>data</td>
          </tr>
          <tr>
            <td>1,015</td>
            <td>random</td>
            <td>tabular</td>
            <td>information</td>
            <td>text</td>
          </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="CSS-JS/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="CSS-JS/dashboard.js"></script>
  </body>
</html>
