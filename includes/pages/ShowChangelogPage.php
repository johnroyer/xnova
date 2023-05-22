<?php

function ShowChangelogPage()
{
    global $USER, $PLANET, $LNG, $LANG;

    $PlanetRess = new ResourceUpdate();
    $PlanetRess->CalcResource();
    $PlanetRess->SavePlanetToDB();

    $template   = new template();

    $LANG->includeLang(array('CHANGELOG'));
    $template->assign_vars(array(
        'ChangelogList' => array_map('makebr', $LNG['changelog']),
        'Version'       => $LNG['Version'],
        'Description'   => $LNG['Description'],
    ));

    $template->show("changelog_overview.tpl");
}
