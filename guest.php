<?php
      if(isset ($_GET['ajax'])){
        $out="";
        if($_GET['ajax']==1 || $_GET['ajax']==2){
            if($_GET['timeframe']==1){
                $json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol='.$_GET['asset'].'&outputsize=compact&apikey=Z6AFRTAJ96TUCC02');
                $data = json_decode($json,true);
                unset($data['Meta Data']);
                $ts=$data['Time Series (Daily)'];
            }

            else if($_GET['timeframe']==2){
                $json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_WEEKLY&symbol='.$_GET['asset'].'&apikey=Z6AFRTAJ96TUCC02');
                $data = json_decode($json,true);
                unset($data['Meta Data']);
                $ts=$data['Weekly Time Series'];
                    }

            else if($_GET['timeframe']==3){
                $json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_MONTHLY&symbol='.$_GET['asset'].'&apikey=Z6AFRTAJ96TUCC02');
                $data = json_decode($json,true);
                unset($data['Meta Data']);
                $ts=$data['Monthly Time Series'];
         } 
        
        }
        foreach ($ts as $stocks){
            $day= array_search($stocks,$ts);
            $final[]=[
              'x'=>$day,
              'y'=>[$stocks['1. open'], $stocks['2. high'], $stocks['3. low'], $stocks['4. close']],
            ];
            }
        echo json_encode($final);
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
   <link href="CSS-JS/styleCrazyWallet2.css" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  </head>
  <body>

  <!-- Top left corner-->
  <header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow" style="background: linear-gradient(to bottom left, #0066ff 23%, #66ffcc 80%); opacity: 0.8">
      <a class="navbar navbar-brand col-md-3 col-lg-2 me-0 px-2 fs-8" href="#" style="background: linear-gradient(to bottom right, #0066ff 23%, #66ffcc 80%);"><p id="logoandcustomer" >
              <button id="logobutton" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation" >
                  <span id="logobutton"> Crazy Wallet </span>
              </button></p></a>
      <span><i id="logoandcustomer" style="color:#00006e">&nbsp;Benvenuto</i></span>&nbsp;
  </header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
        &nbsp;
          <li class="nav-item">
            <a id="nav_link" class="nav-link active" aria-current="page" href="#">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
            </li>
        </ul>

      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        <!-- popolamento select con le azioni e gli ETF -->

            <input type="text" id="asset" class="form-control" placeholder="Azioni o ETF" style="width: 52%; text-transform:uppercase">
            <select id="timeframe"class="form-select"aria-label=".form-select-lg example" style="width: 48%">
            <option selected>Timeframe</option>
            <option value="1">Giornaliero</option>
            <option value="2">Settimanale</option>
            <option value="3">Mensile</option>
        </select>  

        </div>
      </div>

      <div id="chart">
      <script id="script">chart(data)</script>
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
                        $('#chart').empty();
                        $('#script').empty();
                        $('#script').html(chart(response));
                    },
                    cache:true,
                    dataType:"json",
            }
            )
        });

        // In questo ajax (realizzato con la sintassi di jquery) si valuta il cambio del timeframe (giornaliero, settimanale o mensile).

        $("#asset").change(function (){
            console.log($('#asset').val())
            var timeframe=$('#timeframe option:selected').attr("value"),
                asset=$('#asset').val();
            $.ajax({
                    type:"get",
                    data:{timeframe:timeframe,asset:asset,ajax:2},
                    success: function(response){
                        console.log(response);
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