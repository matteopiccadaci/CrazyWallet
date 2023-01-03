<?php
require_once 'operations.php';
?>
<html>
<head>
    <title>Registrazione</title>
    <!-- STILI-->
    <link rel='stylesheet' href ='CSS-JS/css/style.css'>
    <link rel='stylesheet' href ='CSS-JS/styleCrazyWallet14.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">

    <script>
        function register() {

            var data = {};
            data.nome = document.getElementById("nome").value;
            data.cognome = document.getElementById("cognome").value;
            data.wallet = document.getElementById("wallet").value;
            data.pass = document.getElementById("password").value;
            data.passcnf= document.getElementById("passwordcnf").value;
            data.data = document.getElementById("data").value;
            data.mail= document.getElementById("mail").value;
            var jsondata = JSON.stringify(data);
            var req = new XMLHttpRequest();
            req.onload = function(){
                document.getElementById("risposta").removeAttribute("hidden");
                document.getElementById("risposta").innerHTML = req.responseText;
            };
            req.open("POST", "operationsapi.php/add_user", true);
            req.send(jsondata);
        }
        /* Si prendono tutti i dati necessari per la rimozione e si inviano al server tramite una richiesta POST. */
    </script>

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <p style="font-family: 'Brush Script MT', cursive; font-weight:bolder; font-size:50px">Crazy Wallet</p>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Crea il tuo nuovo account</p>
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
                        <label for="password" class="form-label">Conferma password</label>
                        <input type="password" class="form-control"  id="passwordcnf" placeholder="Inserisci di nuovo la password" name="passwordcnf" maxlenght="20">
                    </div>
                    <div class="col-12">
                        <label for="wallet" class="form-label">Wallet</label>
                        <input type="text" class="form-control"  id="wallet" placeholder="Inserisci una stringa alfanumerica" name="wallet" maxlenght="20">
                    </div>
                    <div class="col-12">
                        <label for="data" class="form-label">Data di nascita</label>
                        <input type="date" class="form-control" id="data" name="data"> <!-- Il calendario è dato dal tipo date-->
                    </div>
                    <button name="inviaapi" type="button" class="btn btn-primary" style="width: 100%; text-align: center" onclick="register()">Registrati</button>
                </div>
            <div class="col-12">
                <br>
                <h6>Sei già registrato? <a href="index.php">Accedi qui</a></h6>
                <br>
                <p id="risposta" hidden></p>
            </div>




        </div>

    </div>
</div>

</body>
</html>