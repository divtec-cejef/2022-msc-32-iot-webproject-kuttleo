<?php

require './inc/utils.php';

require MODEL_DIR . 'api.model.php';
$stmtData = getAllMeasures();

$lastMeasure = getLastMeasures();

$MaxMinMeasures = getMaxMinMeasures();

include VIEW_DIR . 'header.view.php';

?>
<body>
<main>
    <h1 id="Timer"> </h1>

    <h2  id="Date"><?php  echo date("d/m/Y")?></h2>

    <script>
        //Fonction permettant d'actualiser le Timer du site
        setInterval(function() {
            var currentTime = new Date ( );
            var currentHours = currentTime.getHours ( );
            var currentMinutes = currentTime.getMinutes ( );
            var currentSeconds = currentTime.getSeconds ( );
            currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
            currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
            var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
            currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
            currentHours = ( currentHours == 0 ) ? 12 : currentHours;
            var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
            document.getElementById("Timer").innerHTML = currentTimeString;
        }, 1000);
    </script>

    <img src="res/background.jpg">

    <div class="Temperature">
        <h2>Température</h2>
        <p>Max : <?php echo $MaxMinMeasures["maxTemp"] ?>°C</p>
        <p>Min : <?php echo $MaxMinMeasures["minTemp"] ?> °C</p>
        <h3 class="Actuel"><?php echo $lastMeasure["temperature_mes"] ?>°C</h3>
    </div>
    <div class="Humidité">
        <h2>Température</h2>
        <p>Max : <?php echo $MaxMinMeasures["maxHumi"] ?>%</p>
        <p>Min : <?php echo $MaxMinMeasures["minHumi"] ?>%</p>
        <h3 class="Actuel"><?php echo $lastMeasure["humidite_mes"] ?>%</h3>
    </div>
    <!-- Flèche -->
    <span>
        <a href="#sectTable">&nbsp;</a>
    </span>
</main>

<section id="sectTable">
    <div>
        <table>
            <caption>Valeurs enregistré dans la salle B1-06</caption>
            <tr>
                <th>ID </th>
                <th>Date</th>
                <th>Température</th>
                <th>Humidité</th>
                <th>&nbsp;</th>
            </tr>
            <tr>
                <?php foreach ($stmtData as $res): ?>
            <tr>
                <td><?=htmlentities($res['pk_mesure'])?></td>
                <td><?=htmlentities($res['date_mes'])?></td>
                <td><?=htmlentities($res['temperature_mes'])?></td>
                <td><?=htmlentities($res['humidite_mes'])?>%</td>
                <td>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td>3</td>
                <td>07-02-2022 14:35</td>
                <td>21°C</td>
                <td>30%</td>
                <td>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </td>
            </tr>
        </table>
    </div>
</section>
<?php
    include VIEW_DIR . 'footer.view.php';
?>