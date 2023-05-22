<?php

if (!defined('INSIDE')) {
    die('Hacking attempt!');
}

function SortUserPlanets($CurrentUser)
{
    global $db;
    $Order = ( $CurrentUser['planet_sort_order'] == 1 ) ? "DESC" : "ASC" ;
    $Sort  = $CurrentUser['planet_sort'];

    $QryPlanets  = "SELECT `id`, `name`, `galaxy`, `system`, `planet`, `planet_type`, `image`, `b_building`, `b_building_id` FROM " . PLANETS . " WHERE `id_owner` = '" . $CurrentUser['id'] . "' AND `destruyed` = '0' ORDER BY ";

    if ($Sort == 0) {
        $QryPlanets .= "`id` " . $Order;
    } elseif ($Sort == 1) {
        $QryPlanets .= "`galaxy`, `system`, `planet`, `planet_type` " . $Order;
    } elseif ($Sort == 2) {
        $QryPlanets .= "`name` " . $Order;
    }

    $PlanetRAW = $db->query($QryPlanets);

    while ($Planet = $db->fetch_array($PlanetRAW)) {
        $Planets[$Planet['id']] = $Planet;
    }

    $db->free_result($PlanetRAW);

    return $Planets;
}
