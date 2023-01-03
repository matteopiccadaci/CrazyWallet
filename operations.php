<?php
function get_user($id){
    require 'config.php';
    $arr=mysqli_fetch_array($connect_db->query("SELECT nome, cognome
        FROM Utenti
        WHERE id_utente=".$id), MYSQLI_ASSOC);
    return [$arr['nome'], $arr['cognome']];;
}

function retreive_user_assets($id)
{
    require 'config.php';
    $id_wallet = mysqli_fetch_array($connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC)['id_wallet'];
    return mysqli_fetch_all($connect_db->query("SELECT DISTINCT asset FROM `$id_wallet`"), MYSQLI_NUM);;
}

function get_allocation($id){
    require 'config.php';
    $id_wallet = mysqli_fetch_array($connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC)['id_wallet'];;
    $arr=mysqli_fetch_all($connect_db->query("SELECT DISTINCT asset FROM `$id_wallet`"), MYSQLI_NUM);;
    foreach ($arr as $a){
        $assets[]=$a[0];
    }
    foreach ($assets as $a){
        $z=mysqli_fetch_array($connect_db->query("SELECT SUM(valore_acquisto) FROM `$id_wallet` WHERE asset='$a'"), MYSQLI_ASSOC);
            $final[]=[
               'asset'=>$a,
                'valore'=> $z['SUM(valore_acquisto)']
            ];
        }
        return $final;
    }

function get_total_value($id){
    require 'config.php';
    $id_wallet = mysqli_fetch_array($connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC)['id_wallet'];
    return mysqli_fetch_all($connect_db->query("SELECT SUM(valore_acquisto) FROM `$id_wallet`"), MYSQLI_NUM)[0][0];;
}

function retreive_quantity($id){
    require 'config.php';
    $id_wallet = mysqli_fetch_array($connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC)['id_wallet'];
    return mysqli_fetch_all($connect_db->query("SELECT SUM(quantita) FROM `$id_wallet`"), MYSQLI_NUM)[0][0];;
}

function retreive_total_quantity($id,$asset){
    require 'config.php';
    $id_wallet = mysqli_fetch_array($connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC)['id_wallet'];
    return mysqli_fetch_all($connect_db->query("SELECT SUM(quantita) FROM `$id_wallet` WHERE asset='$asset'"), MYSQLI_NUM)[0][0];;
}

function get_value_single_asset($id, $asset){
    require 'config.php';
    $id_wallet = mysqli_fetch_array($connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC)['id_wallet'];
    return mysqli_fetch_all($connect_db->query("SELECT SUM(valore_acquisto) FROM `$id_wallet` WHERE asset='$asset'"), MYSQLI_NUM)[0][0];;
}

function get_api_key($id){
    require 'config.php';
    $apikey=mysqli_fetch_array($connect_db->query("SELECT api_key FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC)['api_key'];
    return $apikey;
}



/*Queste sono le operazioni che interagiscono con il Database. Viene sempre preso l'id dell'utente poiché la logica di realizzazione del DB è che , per ogni utente, venga creata una tabella che come identificativo ha l'hash del
wallet inserito in fase di registrazione. In ogni tabella è presente l'intero storico delle operazioni dell'utente.  */
/*


/*
 * Le funzioni seguenti sono state successivamente "trasformate" nelle versioni che utilizzano le API Rest.
 * /

function add_user($nome, $cognome, $mail, $pass, $wallet, $data){
    require 'config.php';
    $pwdLenght = mb_strlen($pass);//controllo se la lunghezza della pass è adatta
    $eta = floor((time() - strtotime($data)) / 31556926);

    if (empty($username) || empty($pass) || empty($nome) || empty($cognome) || empty($data)) {
        return '<script> alert("Compila tutti i campi"); </script>';
    } elseif ($pwdLenght < 4 || $pwdLenght > 20) {
        return "<script> alert ('Registrazione non avvenuta: La lunghezza della password deve essere compresa fra 4 e 20 caratteri')</script>";}

    elseif ($eta<18){
        return "<script> alert('Registrazione non avvenuta: L\'età per registrarsi è di almeno 18 anni') </script>";
    } //errori

    elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL))
        return "<script> alert('Registrazione non avvenuta: Inserisci una mail valida') </script>";

    else {
        $wh=password_hash($connect_db->real_escape_string($wallet), PASSWORD_BCRYPT);// viene creato un wallet all'utenteche verrà salvato in maniera sicura tramite hashing
        $password_hash = password_hash($connect_db->real_escape_string($pass), PASSWORD_BCRYPT);// hashing password
        if ($connect_db->query("INSERT INTO Utenti  (nome,cognome, mail, pass, data_nascita, id_wallet)
                                VALUES ('".$connect_db->real_escape_string($nome)."', '".$connect_db->real_escape_string($cognome)."', '".$connect_db->real_escape_string($mail)."', '".$password_hash."', '".$connect_db->real_escape_string($data)."', '$wh')
                                ")
            &&
            $connect_db->query("CREATE TABLE `$wh` (
                                id_acquisto INT(10) AUTO_INCREMENT PRIMARY KEY,
                                asset VARCHAR(256) NOT NULL,
                                quantita INT(10) NOT NULL,
                                prezzo FLOAT(20) NOT NULL,
                                valore_acquisto FLOAT(20) NOT NULL
                                                    )"
                                )
        ){
            header("location: /index.php");
            return "<script> alert('Registrazione avvenuta!')</script>";
            }
        else {
            return "<script> alert('Registrazione non avvenuta: errore nel database')</script>";
        }

    } //registrazione avvenuta

}
function add_to_wallet($asset, $quantita, $wallet, $id, $prezzo, $valore_finale){
    require 'config.php';
    $q=$connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'");
    $t=mysqli_fetch_array($q, MYSQLI_ASSOC);
    $id_wallet=$t['id_wallet'];
    if (password_verify($wallet, $t['id_wallet'])){
        $i="INSERT INTO `$id_wallet` (asset, quantita, prezzo, valore_acquisto)
                         VALUES ('$asset', '".$connect_db->real_escape_string($quantita)."', '$prezzo', '$valore_finale')";
        if ($connect_db->query($i)===TRUE)
            return "<script> alert('Inserimento effettuato')</script>";
        else
            return "<script> alert('Inserimento non avvenuto, riprova')</script>";
    }
    else  return "<script> alert('Qualcosa è andato storto...')</script>";
}

function remove_from_wallet ($asset, $quantita, $wallet, $id, $prezzo, $valore_finale){
    require 'config.php';
    $t=mysqli_fetch_array($connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC);
    $id_wallet=$t['id_wallet'];
    $tot=(int) mysqli_fetch_array($connect_db->query("SELECT SUM(quantita) FROM `$id_wallet` WHERE asset='$asset'"), MYSQLI_ASSOC)['SUM(quantita)'];
    if (password_verify($wallet, $t['id_wallet']) && ($tot>=$quantita)){
        $i="INSERT INTO `$id_wallet` (asset, quantita, prezzo, valore_acquisto)
                         VALUES ('$asset', '".$connect_db->real_escape_string($quantita)."', '$prezzo', '$valore_finale')";
        if ($connect_db->query($i)===TRUE)
            return "<script> alert('Rimozione effettuata')</script>";
        else
            return "<script> alert('Rimozionr non avvenuto, riprova')</script>";
    }
    else  return "<script> alert('Qualcosa è andato storto...')</script>";
}

 */