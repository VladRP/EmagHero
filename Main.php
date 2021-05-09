<?php

require_once "Orderus.php";
require_once "WildBeast.php";
require_once "Battle.php";

$orderus = new Orderus();
$wildBeast = new WildBeast();

$battle = new Battle();
$battle->fight($orderus, $wildBeast);

foreach ($battle->getFightLogs() as $round => $fightLogs) {
    echo 'Round: '.$round."</br>";

    foreach ($fightLogs as $fightLog) {
        echo $fightLog."</br>";
    }
}
