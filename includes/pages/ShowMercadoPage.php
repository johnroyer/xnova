<?php

function ShowMercadoPage()
{
    global $USER, $PLANET, $LNG, $LANG;

    $PlanetRess = new ResourceUpdate();
    $PlanetRess->CalcResource();
    $PlanetRess->SavePlanetToDB();

    $template   = new template();

    $template->assign_vars(array(
        'mercado_negro'     => $LNG['mercado_negro'],
        'comerciante'   => $LNG['comerciante'],
        'bonus' => $LNG['bonus_n'],
        'mercado_negro_desc'        => $LNG['mercado_negro_desc'],
        'comerciante_desc'  => $LNG['comerciante_desc'],
        'bonus_desc' => $LNG['bonus_n_desc'],
    ));

    $template->show("mercado_general.tpl");
}
