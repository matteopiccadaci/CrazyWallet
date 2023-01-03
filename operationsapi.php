<?php
require ('config.php');
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
$function = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));

if ($method==='GET'){
    $elems=explode('&',$_SERVER['QUERY_STRING']);
    $id=preg_replace('/[^0-9]+/i','',$elems[0]);
    $api_key=preg_replace('/[^a-z0-9]+/i','',$elems[1]);
}
if(isset($input)){
    $columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
    foreach ($columns as $value){
       if ($value===null)
            echo "Errore: uno o più campi non sono stati compilati.";
        else {
           $elems[$value]=$input[$value];
        }
    }
}
switch($function) {

    case 'add_user':{
        require 'config.php';
        $nome=$elems['nome'];
        $cognome=$elems['cognome'];
        $mail=$elems['mail'];
        $pass=$elems['pass'];
        $passcnf=$elems['passcnf'];
        $wallet=$elems['wallet'];
        $data=$elems['data'];


        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 21; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        /* Generazione dell'API key casuale */

        $pwdLenght = mb_strlen($pass);// controllo se la lunghezza della pass è adatta
        $eta = floor((time() - strtotime($data)) / 31556926);

        if ($pass==null|| $nome==null || $cognome==null || $data==null || $mail==null || $wallet==null || $passcnf==null)
            echo "Registrazione non avvenuta: Compila tutti i campi";

        elseif ($pwdLenght < 4 || $pwdLenght > 20)
            echo "Registrazione non avvenuta: La lunghezza della password deve essere compresa fra 4 e 20 caratteri";

        elseif ($eta < 18)
            echo "Registrazione non avvenuta: Per iscriverti occorre essere maggiorenni";

        elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            echo "Registrazione non avvenuta: Inserisca una mail valida";

        elseif ($pass != $passcnf)
            echo "Registrazione non avvenuta: Le password non coincidono";

        //errori

        else {
            $wh = password_hash($connect_db->real_escape_string($wallet), PASSWORD_BCRYPT);// viene creato un wallet all'utenteche verrà salvato in maniera sicura tramite hashing
            $password_hash = password_hash($connect_db->real_escape_string($pass), PASSWORD_BCRYPT);// hashing password
            if ($connect_db->query("INSERT INTO Utenti  (nome,cognome, mail, pass, data_nascita, id_wallet, api_key)
                                VALUES ('" . $connect_db->real_escape_string($nome) . "', '" . $connect_db->real_escape_string($cognome) . "', '" . $connect_db->real_escape_string($mail) . "', '" . $password_hash . "', '" . $connect_db->real_escape_string($data) . "', '$wh', '$randomString')
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
            ) {
                echo 'Registrazione avvenuta, puoi effettuare il login!';
            } else {
                echo 'Registrazione non avvenuta: errore nel database';
            }

        } // Registrazione avvenuta: aggiunta dell'utente con informazioni, wallet e api key e creazione della tabella per il wallet.

    } break;

    case 'add_to_wallet':{
        require 'config.php';
        $id=$elems['id'];
        $asset=$elems['asset'];
        $quantita=$elems['quantita'];
        $prezzo=$elems['prezzo'];
        $valore_finale=$elems['valore_finale'];
        $wallet=$elems['wallet'];
        $q = $connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'");
        $t = mysqli_fetch_array($q, MYSQLI_ASSOC);
        $id_wallet = $t['id_wallet'];
        if (password_verify($wallet, $t['id_wallet'])) {
            $i = "INSERT INTO `$id_wallet` (asset, quantita, prezzo, valore_acquisto)
                         VALUES ('$asset', '" . $connect_db->real_escape_string($quantita) . "', '$prezzo', '$valore_finale')";
            if ($connect_db->query($i) === TRUE)
                echo "Inserimento correttamente effettuato";
            else
                echo "Inserimento non avvenuto, riprova";
        } else  echo "Qualcosa è andato storto...";
    } break;

    case 'retreive_user_assets':{
        function retreive_user_assets($id)
    {
        require 'config.php';
        $id_wallet = mysqli_fetch_array($connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC)['id_wallet'];
        return mysqli_fetch_all($connect_db->query("SELECT DISTINCT asset FROM `$id_wallet`"), MYSQLI_NUM);;
    }} break;

    case 'remove_from_wallet':{
        require 'config.php';
        $asset= $elems['asset'];
        $quantita= (int)$elems['quantita'];
        $wallet= $elems['wallet'];
        $id= $elems['id'];
        $prezzo= (int)$elems['prezzo'];
        $valore_finale= (int)$elems['valore_finale'];
        $valore_finale= $valore_finale*(-1);
        $t = mysqli_fetch_array($connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC);
        $id_wallet = $t['id_wallet'];
        $tot = (int)mysqli_fetch_array($connect_db->query("SELECT SUM(quantita) FROM `$id_wallet` WHERE asset='$asset'"), MYSQLI_ASSOC)['SUM(quantita)'];
        if (password_verify($wallet, $t['id_wallet']) && ($tot >= $quantita)) {
            $quantita= $quantita*(-1);
            $i = "INSERT INTO `$id_wallet` (asset, quantita, prezzo, valore_acquisto)
                         VALUES ('$asset', '" . $connect_db->real_escape_string($quantita) . "', '$prezzo', '$valore_finale')";
            if ($connect_db->query($i) === TRUE)
                echo "Rimozione effettuata correttamente";
            else
                echo "Rimozione non avvenuta, riprova";
        } else  echo "Qualcosa è andato storto...";
    } break;

    case 'export':{
        require 'operations.php';
        $id/=678602;
    $t = mysqli_fetch_array($connect_db->query("SELECT api_key FROM Utenti WHERE id_utente='$id'"), MYSQLI_ASSOC);
    $api_key=substr($api_key, 6);
    // L'api key viene restituita con una parte di caretteri superflui (in questo caso 6) che vengono rimossi.
    if ($api_key == $t['api_key']) {
        foreach (retreive_user_assets($id) as $asset){
            $asset = $asset[0];
            $quantita = retreive_total_quantity($id, $asset);
            if ($quantita > 0){
                $final[$asset] = $quantita;
            }
        }
        echo json_encode($final);
    }
    else echo "Qualcosa è andato storto...";

    // La funzione restituisce un json con i dati di tutti gli asset dell'utente, tramite l'api key e l'id utente.

    }break;

    case 'import':
    {
    require 'operations.php';
    require 'finance.php';
    $id=$elems['id'];
    unset($elems['id']);
        $q = $connect_db->query("SELECT id_wallet FROM Utenti WHERE id_utente='$id'");
        $t = mysqli_fetch_array($q, MYSQLI_ASSOC);
        $id_wallet = $t['id_wallet'];
        $assets=array_keys($elems);
        $tot=0;
    foreach ($assets as $asset){
       $prezzo=get_intraday_asset_price($asset);
       $quantita=$elems[$asset];
       $valore_finale=round(get_intraday_asset_total($asset, $quantita),2);
        $i = "INSERT INTO `$id_wallet` (asset, quantita, prezzo, valore_acquisto)
                         VALUES ('$asset', '" . $quantita."', '$prezzo', '$valore_finale')";
        if ($connect_db->query($i) === TRUE)
            $tot++;
    }
    if ($tot == count($assets))
        echo 'Wallet importato correttamente!';
    else
        echo 'Qualcosa è anadato storto...';

    } break;

    /* Dalla richiesta viene estratto l'id utente e l'array con gli asset da importare.
    Per ogni asset viene calcolato il prezzo d'acquisto moltiplicando la quantità per il prezzo attuale e successivamente viene inserito nel wallet.
    Viene infine fatto un controllo per verificare che tutti gli asset siano stati inseriti correttamente.
     */
}

/*Le operazioni in cui è l'utente ad agire con il Database sono state realizzate tramite API.  */