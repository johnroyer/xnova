<?php

if (!defined('INSIDE')) {
    die('Hacking attempt!');
}

function CreateOneMoonRecord($Galaxy, $System, $Planet, $Universe, $Owner, $MoonID, $MoonName, $Chance, $Size = 0)
{
    global $LNG, $USER, $db;

    $SQL  = "SELECT id_luna,planet_type,id,name,temp_max,temp_min FROM " . PLANETS . " ";
    $SQL .= "WHERE ";
    $SQL .= "`universe` = '" . $Universe . "' AND ";
    $SQL .= "`galaxy` = '" . $Galaxy . "' AND ";
    $SQL .= "`system` = '" . $System . "' AND ";
    $SQL .= "`planet` = '" . $Planet . "' AND ";
    $SQL .= "`planet_type` = '1';";
    $MoonPlanet = $db->uniquequery($SQL);

    if ($MoonPlanet['id_luna'] != 0) {
        return false;
    }

    if ($Size == 0) {
        $size   = floor(pow(mt_rand(10, 20) + 3 * $Chance, 0.5) * 1000);
    } else {
        $size   = $Size;
    }

    $maxtemp    = $MoonPlanet['temp_max'] - mt_rand(10, 45);
    $mintemp    = $MoonPlanet['temp_min'] - mt_rand(10, 45);

    $SQL  = "INSERT INTO " . PLANETS . " SET ";
    #$SQL .= "`name` = '".( ($MoonName == '') ? $LNG['fcm_moon'] : $MoonName )."', ";
    $SQL .= "`name` = '" . $LNG['fcm_moon'] . "', ";
    $SQL .= "`id_owner` = '" . $Owner . "', ";
    $SQL .= "`universe` = '" . $Universe . "', ";
    $SQL .= "`galaxy` = '" . $Galaxy . "', ";
    $SQL .= "`system` = '" . $System . "', ";
    $SQL .= "`planet` = '" . $Planet . "', ";
    $SQL .= "`last_update` = '" . TIMESTAMP . "', ";
    $SQL .= "`planet_type` = '3', ";
    $SQL .= "`image` = 'mond', ";
    $SQL .= "`diameter` = '" . $size . "', ";
    $SQL .= "`field_max` = '1', ";
    $SQL .= "`temp_min` = '" . $mintemp . "', ";
    $SQL .= "`temp_max` = '" . $maxtemp . "', ";
    $SQL .= "`metal` = '0', ";
    $SQL .= "`metal_perhour` = '0', ";
    $SQL .= "`metal_max` = '" . BASE_STORAGE_SIZE . "', ";
    $SQL .= "`crystal` = '0', ";
    $SQL .= "`crystal_perhour` = '0', ";
    $SQL .= "`crystal_max` = '" . BASE_STORAGE_SIZE . "', ";
    $SQL .= "`deuterium` = '0', ";
    $SQL .= "`deuterium_perhour` = '0', ";
    $SQL .= "`deuterium_max` = '" . BASE_STORAGE_SIZE . "',";
    $SQL .= "`norio` = '0', ";
    $SQL .= "`norio_perhour` = '0', ";
    $SQL .= "`norio_max` = '" . BASE_STORAGE_SIZE . "'; ";
    $db->query($SQL);

    $SQL  = "UPDATE " . PLANETS . " SET ";
    $SQL .= "`id_luna` = '" . $db->GetInsertID() . "' ";
    $SQL .= "WHERE ";
    $SQL .= "`universe` = '" . $Universe . "' AND ";
    $SQL .= "`galaxy` = '" . $Galaxy . "' AND ";
    $SQL .= "`system` = '" . $System . "' AND ";
    $SQL .= "`planet` = '" . $Planet . "' AND ";
    $SQL .= "`planet_type` = '1';";
    $db->query($SQL);

    return $MoonPlanet['name'];
}
