<?php

function ShowFAQPage()
{
    global $USER, $PLANET, $LNG, $LANG;
    $PlanetRess = new ResourceUpdate();
    $PlanetRess->CalcResource();
    $PlanetRess->SavePlanetToDB();

    $template   = new template();

    $LANG->includeLang(array('FAQ'));
    $template->assign_vars(array(
        'FAQList'       => $LNG['faq'],
        'faq_overview'  => $LNG['faq_overview'],
    ));

    $template->show("faq_overview.tpl");
}
