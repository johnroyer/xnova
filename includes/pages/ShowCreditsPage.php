<?php

/**
 _  \_/ |\ | /¯¯\ \  / /\    |¯¯) |_¯ \  / /¯¯\ |  |   |´¯|¯` | /¯¯\ |\ |5
 ¯  /¯\ | \| \__/  \/ /--\   |¯¯\ |__  \/  \__/ |__ \_/   |   | \__/ | \|Core.
 * @author: Copyright (C) 2011 by Brayan Narvaez (Prinick) developer of xNova Revolution
 * @author web: http://www.bnarvaez.com
 * @link: http://www.xnovarev.com
 *
 * Please do not remove the credits
*/

function ShowCreditsPage()
{
    global $USER, $PLANET, $LNG, $LANG;

    $PlanetRess = new ResourceUpdate();
    $PlanetRess->CalcResource();
    $PlanetRess->SavePlanetToDB();

    $template   = new template();
    $template->show("creditos_overview.tpl");
}
