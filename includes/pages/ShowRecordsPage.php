<?php

require(ROOT_PATH . 'includes/classes/class.Records.php');

function ShowRecordsPage()
{
    global $USER, $PLANET, $LNG, $resource, $db, $CONF, $UNI;

    $PlanetRess = new ResourceUpdate();
    $PlanetRess->CalcResource();
    $PlanetRess->SavePlanetToDB();

    $template   = new template();

    $Records        = new records();
    $RecordsArray   = $Records->GetRecords($UNI);

    foreach ($RecordsArray as $ElementID => $ElementIDArray) {
        if ($ElementID >=   1 && $ElementID <=  39 || $ElementID == 44) {
            $Builds[$LNG['tech'][$ElementID]]   = array(
                'id'            => $ElementID,
                'winner'    => ($ElementIDArray['maxlvl'] != 0) ? $ElementIDArray['username'] : $LNG['rec_rien'],
                'count'     => ($ElementIDArray['maxlvl'] != 0) ? pretty_number($ElementIDArray['maxlvl']) : $LNG['rec_rien'],
            );
        } elseif ($ElementID >=  41 && $ElementID <= 99 && $ElementID != 44) {
            $MoonsBuilds[$LNG['tech'][$ElementID]]  = array(
                'id'          => $ElementID,
                'winner'    => ($ElementIDArray['maxlvl'] != 0) ? $ElementIDArray['username'] : $LNG['rec_rien'],
                'count'     => ($ElementIDArray['maxlvl'] != 0) ? pretty_number($ElementIDArray['maxlvl']) : $LNG['rec_rien'],
            );
        } elseif ($ElementID >= 101 && $ElementID <= 199) {
            $Techno[$LNG['tech'][$ElementID]]   = array(
                'id'            => $ElementID,
                'winner'    => ($ElementIDArray['maxlvl'] != 0) ? $ElementIDArray['username'] : $LNG['rec_rien'],
                'count'     => ($ElementIDArray['maxlvl'] != 0) ? pretty_number($ElementIDArray['maxlvl']) : $LNG['rec_rien'],
            );
        } elseif ($ElementID >= 201 && $ElementID <= 399) {
            $Fleet[$LNG['tech'][$ElementID]]    = array(
                'id'            => $ElementID,
                'winner'    => ($ElementIDArray['maxlvl'] != 0) ? $ElementIDArray['username'] : $LNG['rec_rien'],
                'count'     => ($ElementIDArray['maxlvl'] != 0) ? pretty_number($ElementIDArray['maxlvl']) : $LNG['rec_rien'],
            );
        } elseif ($ElementID >= 401 && $ElementID <= 599) {
            $Defense[$LNG['tech'][$ElementID]]  = array(
                'id'            => $ElementID,
                'winner'    => ($ElementIDArray['maxlvl'] != 0) ? $ElementIDArray['username'] : $LNG['rec_rien'],
                'count'     => ($ElementIDArray['maxlvl'] != 0) ? pretty_number($ElementIDArray['maxlvl']) : $LNG['rec_rien'],
            );
        }
    }

    $Records    = array(
        $LNG['rec_build']   => $Builds,
        $LNG['rec_specb']   => $MoonsBuilds,
        $LNG['rec_techn']   => $Techno,
        $LNG['rec_fleet']   => $Fleet,
        $LNG['rec_defes']   => $Defense,
    );

    $template->assign_vars(array(
        'Records'       => $Records,
        'update'        => sprintf($LNG['rec_last_update_on'], date(TDFORMAT, $CONF['stat_last_update'])),
        'level'         => $LNG['rec_level'],
        'player'        => $LNG['rec_playe'],
    ));

    $template->show("records/records_overview.tpl");
}
