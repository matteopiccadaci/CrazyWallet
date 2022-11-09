<?php
require_once 'operations.php';
if (isset($_POST['registrati'])) {
    echo add_user($_POST['nome'], $_POST['cognome'], $_POST['mail'], $_POST['password'], $_POST['wallet'], $_POST['data']);
}
?>
<html>
<head>
    <title>Registrazione</title>
    <!-- STILI-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel='stylesheet' href ='CSS-JS/css/style.css'>
    <link rel='stylesheet' href ='CSS-JS/styleCrazyWallet14.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <p style="font-family: 'Brush Script MT', cursive; font-weight:bolder; font-size:50px">Crazy Wallet</p>
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
                        <input type="text" class="form-control"  id="wallet" placeholder="Inserisci una stringa alfanumerica" name="wallet" maxlenght="20">
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
</html>