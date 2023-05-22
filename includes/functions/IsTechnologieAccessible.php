<?php

if (!defined('INSIDE')) {
    die('Hacking attempt!');
}

function IsTechnologieAccessible($CurrentUser, $CurrentPlanet, $Element)
{
    global $requeriments, $resource, $reslist;

    if (!isset($requeriments[$Element])) {
        return true;
    }

    foreach ($requeriments[$Element] as $ReqElement => $EleLevel) {
        if ((isset($CurrentPlanet[$resource[$ReqElement]]) && $CurrentPlanet[$resource[$ReqElement]] < $EleLevel) || (isset($CurrentUser[$resource[$ReqElement]]) && $CurrentUser[$resource[$ReqElement]] < $EleLevel)) {
            return false;
        }
    }
    return true;
}
