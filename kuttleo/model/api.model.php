<?php

function getAllMeasures(){

    //  Inistialisation
    $ch = curl_init();
    // renvoie la réponse, si elle est fausse,elle affichera la réponse.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // setup de l'url
    curl_setopt($ch, CURLOPT_URL, 'https://kuttleo.divtec.me/api/devices/1/mesures');
    // Exécution de la requete
    $result=curl_exec($ch);
    // Fermeture de la communication
    curl_close($ch);

    // decodage du json retourner
    $measures = json_decode($result, true);
    return $measures;
}

function getMeasure($id){

    $urlValue = 'https://kuttleo.divtec.me/api/devices/1/mesures/' + $id;

    //  Inistialisation
    $ch = curl_init();
    // renvoie la réponse, si elle est fausse,elle affichera la réponse.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // setup de l'url
    curl_setopt($ch, CURLOPT_URL, $urlValue);
    // Exécution de la requete
    $result=curl_exec($ch);
    // Fermeture de la communication
    curl_close($ch);

    // decodage du json retourner
    $measures = json_decode($result, true);
    return $measures;
}

function getMaxMinMeasures(){



    $AllMeasures = getAllMeasures();

    $maxTemp = 0;
    $minTemp = $AllMeasures[0]['temperature_mes'];

    $maxHumi = 0;
    $minHumi = $AllMeasures[0]['humidite_mes'];

foreach ($AllMeasures as $row):
    $latestDate = strtotime($row['date_heure']);
    $latestDate = date('Y-m-d', $latestDate);

    //if($latestDate == date("Y-m-d")){
        //Température
        if($maxTemp < $row['temperature_mes']){
            $maxTemp = $row['temperature_mes'];
        }else if($minTemp > $row['temperature_mes']){
            $minTemp = $row['temperature_mes'];
        }
        //Humidité
        if($maxHumi < $row['humidite_mes']){
            $maxHumi = $row['humidite_mes'];
        }else if($minHumi > $row['humidite_mes']){
            $minHumi = $row['humidite_mes'];
        }
    //}
endforeach;

    $measures = [
        "maxTemp" => $maxTemp,
        "minTemp" => $minTemp,
        "maxHumi" => $maxHumi,
        "minHumi" => $minHumi
        ];

    return $measures;
}

function getLastMeasures(){

    $allMeasure = getAllMeasures();
    $lastMeasure =  end($allMeasure);
    return $lastMeasure;
}

?>