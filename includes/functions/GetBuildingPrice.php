<?php

if (!defined('INSIDE')) {
    die('Hacking attempt!');
}

function GetBuildingPrice($CurrentUser, $CurrentPlanet, $Element, $Incremental = true, $ForDestroy = false)
{
    global $pricelist, $resource;

    if ($Incremental) {
        $level = (isset($CurrentPlanet[$resource[$Element]])) ? $CurrentPlanet[$resource[$Element]] : $CurrentUser[$resource[$Element]];
    }

    $array = array('metal', 'crystal', 'deuterium', 'norio', 'darkmatter', 'energy_max');
    foreach ($array as $ResType) {
        if ($CurrentUser['geologe'] >= 1) {
            $cost[$ResType] = $Incremental ? floor($pricelist[$Element][$ResType] * pow($pricelist[$Element]['factor'], $level)) : floor($pricelist[$Element][$ResType]);
            $porcentaje = $cost[$ResType] * 20 / 100;
            $cost[$ResType] = $cost[$ResType] - $porcentaje;
        } else {
            $cost[$ResType] = $Incremental ? floor($pricelist[$Element][$ResType] * pow($pricelist[$Element]['factor'], $level)) : floor($pricelist[$Element][$ResType]);
        }

        if ($ForDestroy == true) {
            $cost[$ResType] /= 2;
        }
    }

    return ($cost);
}
