<?php
$username="crazywallet";
$password="";
$address="localhost";
$db_name="my_crazywallet";
$connect_db= new mysqli($address,$username,$password,$db_name);
if ($connect_db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// viene realizzato il file di configurazione per evitare di dover ripetere il codice per la connessione in ogni pagina.