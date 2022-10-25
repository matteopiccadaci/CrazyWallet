<?php
require_once("php/config.php");
session_start();
if(isset($_POST['logincli'])){
    $mail=$_POST['mail'];
    $password=$_POST['password'];
    $querypass="SELECT id_utente, pass FROM Utenti WHERE mail='$mail'";
    $result=$connect_db->query($querypass);
    $arr=mysqli_fetch_array($result, MYSQLI_ASSOC);
    if(password_verify($password,$arr['pass'])){
        $_SESSION['id']=$arr['id_utente'];
        header("location: /dashboard.php");
    }
    else echo "<script> alert ('Mail o Password errate')";

}
?>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Login Clienti</title>
    <!-- STILI-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel='stylesheet' href ='CSS-JS/css/style.css'>
    <link rel='stylesheet' href ='CSS-JS/styleCrazyWallet2.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="dashboard.php"><p style="font-family: 'Brush Script MT', cursive; font-weight:bolder; font-size:50px">Crazy Stocks</p></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Accedi al tuo account</p>

            <form method="post" class="row g-3">
                <div class="col-12">
                    <label for="mail" class="form-label">Email</label>
                    <input type="email" id="mail" placeholder="Inserisci la tua mail" name="mail" class="form-control">
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"  id="password" placeholder="Inserisci una password" name="password"  class="form-control">
                </div>
                <input type="text" id="logincli" name="logincli" hidden value="1">
                <button id="logincli" type="submit" name="logincli" class="btn btn-primary"> Accedi </button>
        </div>
        <div class="col-12">
            <h6>Non sei registrato? <a href="registrazione.php"> Premi qui</a> e registrati</h6>
        </div>
        </form>
    </div>
</div>
</div>

<script src="CSS-JS/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="CSS-JS/dist/js/adminlte.min.js"></script>
<script src="CSS-JS/plugins/jquery/jquery.min.js"></script>

</body>
</html>
