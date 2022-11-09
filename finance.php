<?php
function get_asset($asset, $timeframe){
        $json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_'.$timeframe.'&symbol='.$asset.'&apikey=Z6AFRTAJ96TUCC02');
        $data = json_decode($json,true);
        unset($data['Meta Data']);
    if ($timeframe == 'DAILY'){
        return $data['Time Series (Daily)'];
    }
    else if ($timeframe == 'WEEKLY'){
        return $data['Weekly Time Series'];
    }
    else if ($timeframe == 'MONTHLY'){
       return $data['Monthly Time Series'];
    }
    if ($timeframe == 'INTRADAY'){
        return $data['Time Series (1min)'];
    }
}
function get_intraday_asset_price($asset){
        $json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol='.$asset.'&interval=1min&apikey=Z6AFRTAJ96TUCC02');
        $data = json_decode($json,true);
        if (isset($data['Error Message'])){
            return "Non sono presenti dati per questo asset.";
        }
        else {
            unset($data['Meta Data']);
            $ts = array_values($data['Time Series (1min)']);
            $now =array_values($ts[0]);
            return  mb_substr($now[0], 0, -2);
        }
}

function get_intraday_asset_total($asset, $q){
    $json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol='.$asset.'&interval=1min&apikey=Z6AFRTAJ96TUCC02');
    $data = json_decode($json,true);
    if (isset($data['Error Message'])){
        return "Non sono presenti dati per questo asset.";
    }
    else {
        unset($data['Meta Data']);
        $data=$data['Time Series (1min)'];
        if (gettype($data) != "array")
            return "Ricarica la pagina per aggiornare i dati.";
        $ts = array_values($data);
        $now =array_values($ts[0]);
        if($q!=0) {
            return $now[0] * $q;
        }
    }
}

function get_value_allocation($allocation, $tot){
    foreach ($allocation as $asset){
        $final[] = [
            'asset' => $asset['asset'],
            'valore' => 100*($asset['valore']/$tot)
        ];
    }
    return $final;
}

function get_asset_today($asset){
    $json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol='.$asset.'&apikey=Z6AFRTAJ96TUCC02');
    $data = json_decode($json,true);
    unset($data['Meta Data']);
    $ts = array_values($data['Time Series (Daily)']);
    return $ts[0];
}

/* Queste sono tutte le funzioni che fanno uso delle API di AlphaVantage. In particolare, nella prima di genera un array in base al timeframe selezionato (per Daily, Weekly e Monthly la struttura del JSON di risposta è il medesimo).
Per gli intraday ci sono due funzioni differenti per essere certi che il valore sia preso singolarmente, sia totale sia quello più aggiornato.*/
