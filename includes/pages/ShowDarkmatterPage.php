<?php

if (!defined('INSIDE')) {
    die('Hacking attempt!');
}

function ShowDarkmatterPage()
{
    global $USER, $PLANET, $LNG, $LANG, $db;
    $PlanetRess = new ResourceUpdate();
    $PlanetRess->CalcResource();
    $PlanetRess->SavePlanetToDB();

    $template    = new template();
    $Mode = $_GET['pack'];
    $darkmatter = $USER['darkmatter'];
    $norio = $PLANET['norio'];
    $norio1 = 100000000;
    $norio1_darkmatter = 100000;
    $norio2 = 1000000000;
    $norio2_darkmatter = 1000000;

#PACK 1
    if ($Mode == 'norio1' && $norio >= $norio1) {
        $aendern = $db->query("UPDATE " . USERS . " SET darkmatter=darkmatter+" . $norio1_darkmatter . " WHERE id= '" . $USER['id'] . "';");
        $aendern = $db->query("UPDATE " . PLANETS . " SET norio=norio-" . $norio1 . " WHERE `galaxy`='" . $PLANET['galaxy'] . "'
                               AND `system` ='" . $PLANET['system'] . "'
                               AND `planet` ='" . $PLANET['planet'] . "'
                               AND `planet_type` ='" . $PLANET['planet_type'] . "'
                               ", 'planets');

        $template->message($LNG['dm_pack_ok'], "?page=materiaoscura", 4);
                exit;
    } elseif ($norio < $norio1 && $Mode == 'norio1') {
        $template->message($LNG['dm_pack_no'], "?page=materiaoscura", 4);
        exit;
    }

#PACK 2
    if ($Mode == 'norio2' && $norio >= $norio2) {
        $aendern = $db->query("UPDATE " . USERS . " SET darkmatter=darkmatter+" . $norio2_darkmatter . " WHERE id= '" . $USER['id'] . "';");
        $aendern = $db->query("UPDATE " . PLANETS . " SET norio=norio-" . $norio2 . " WHERE `galaxy`='" . $PLANET['galaxy'] . "'
                               AND `system` ='" . $PLANET['system'] . "'
                               AND `planet` ='" . $PLANET['planet'] . "'
                               AND `planet_type` ='" . $PLANET['planet_type'] . "'
                               ", 'planets');

        $template->message($LNG['dm_pack_ok'], "?page=materiaoscura", 4);
                exit;
    } elseif ($norio < $norio1 && $Mode == 'norio1') {
        $template->message($LNG['dm_pack_no'], "?page=materiaoscura", 4);
        exit;
    }

    $template->assign_vars(array(
        'dm_pack_norio' => $LNG['dm_pack_norio'],
        'de_materia' => $LNG['de_materia'],
        'comprar' => $LNG['packs_comprar'],
        'caja' => $LNG['caja'],
        'cantidad_norio1' => pretty_number($norio1),
        'cantidad_norio1_materia' => pretty_number($norio1_darkmatter),
        'cantidad_norio2' => pretty_number($norio2),
        'cantidad_norio2_materia' => pretty_number($norio2_darkmatter),
    ));
    $template->show("darkmatter_page.tpl");
}
