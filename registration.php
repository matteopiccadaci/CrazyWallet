<?php
require_once ("php/config.php");
if (isset($_POST['registrati'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['password'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $data= $_POST['data'];
    $wallet= $_POST['wallet'];
    $pwdLenght = mb_strlen($pass);//controllo se la lunghezza della pass è adatta
    $eta = floor((time() - strtotime($data)) / 31556926);

    if (empty($username) || empty($pass) || empty($nome) || empty($cognome) || empty($data)) {
        $msg= 'Compila tutti i campi %s';
    } elseif ($pwdLenght < 4 || $pwdLenght > 20) {
        echo "<script> alert ('Registrazione non avvenuta: La lunghezza della password deve essere compresa fra 4 e 20 caratteri')</script>";}

    elseif ($eta<18){
        echo "<script> alert('Registrazione non avvenuta: L\'età per registrarsi è di almeno 18 anni') </script>";
    } //errori


    else {
        $wh=password_hash($wallet, PASSWORD_BCRYPT);// viene creato un wallet all'utenteche verrà salvato in maniera sicura tramite hashing
        $password_hash = password_hash($pass, PASSWORD_BCRYPT);// hashing password
        $query = "
                INSERT INTO Utenti  (nome,cognome, mail, pass, data_nascita, id_wallet)
                VALUES ('$nome', '$cognome', '$mail', '$password_hash', '$data', '$wh')
            ";
        if ($result=$connect_db->query($query)){
            header("location: /index.php");
            echo "<script> alert('Registrazione avvenuta!')</script>";

        }
    } //registrazione avvenuta

}
?>
<html>
<head>
    <title>Registrazione</title>
    <!-- STILI-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel='stylesheet' href ='CSS-JS/css/style.css'>
    <link rel='stylesheet' href ='CSS-JS/styleCrazyWallet2.css'>

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="dashboard.php"><p style="font-family: 'Brush Script MT', cursive; font-weight:bolder; font-size:50px">Crazy Wallet</p></a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Crea il tuo nuovo account</p>
            <form method="post" action="registrazione.php">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
                    </div>
                    <div class="col-md-6">
                        <label for="cognome" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="cognome" placeholder="Cognome" name="cognome">
                    </div>
                    <br>
                    <div class="col-12">
                        <label for="mail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="mail" placeholder="Inserisci la tua mail" name="mail" maxlength="50">
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control"  id="password" placeholder="Inserisci una password" name="password" maxlenght="20">
                    </div>
                    <div class="col-12">
                        <label for="wallet" class="form-label">Wallet</label>
                        <input type="text" class="form-control"  id="wallet" placeholder="Inserisci una stringa alfanumerica " name="wallet" maxlenght="20">
                    </div>
                    <div class="col-12">
                        <label for="data" class="form-label">Data di nascita</label>
                        <input type="date" class="form-control" id="data" name="data"> <!-- Il calendario è dato dal tipo date-->
                    </div>
                    <input type="text" id="registrati" name="registrati" hidden value="1">
                    <button  type="submit" name="registrati" class="btn btn-primary"> Registrati </button>
                </div>
            </form>
            <div class="col-12">
                <br>
                <h6>Sei già registrato? <a href="index.php">Accedi qui</a></h6>
            </div>


        </div>

    </div>
</div>

</body>