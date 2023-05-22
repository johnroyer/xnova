<?php

function ShowCreditsPage()
{
    global $USER, $PLANET, $LNG, $LANG;

    $PlanetRess = new ResourceUpdate();
    $PlanetRess->CalcResource();
    $PlanetRess->SavePlanetToDB();

    $template   = new template();
    $template->show("creditos_overview.tpl");
}
