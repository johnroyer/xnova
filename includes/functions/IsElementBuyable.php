<?php

if (!defined('INSIDE')) {
    die('Hacking attempt!');
}

function IsElementBuyable($USER, $PLANET, $Element, $Incremental = true, $ForDestroy = false)
{
    global $pricelist, $resource;

    include_once(ROOT_PATH . 'includes/functions/IsVacationMode.php');

    if (IsVacationMode($USER)) {
        return false;
    }

    if ($Incremental) {
        $level  = isset($PLANET[$resource[$Element]]) ? $PLANET[$resource[$Element]] : $USER[$resource[$Element]];
    }

    $array    = array('metal', 'crystal', 'deuterium', 'norio', 'energy_max', 'darkmatter');

    foreach ($array as $ResType) {
        if (empty($pricelist[$Element][$ResType])) {
            continue;
        }

        $cost[$ResType] = $Incremental ? floor($pricelist[$Element][$ResType] * pow($pricelist[$Element]['factor'], $level)) : floor($pricelist[$Element][$ResType]);

        if ($ForDestroy) {
            $cost[$ResType]  = floor($cost[$ResType] / 2);
        }

        if ((isset($PLANET[$ResType]) && $cost[$ResType] > $PLANET[$ResType]) || (isset($USER[$ResType]) && $cost[$ResType] > $USER[$ResType])) {
            return false;
        }
    }
    return true;
}
