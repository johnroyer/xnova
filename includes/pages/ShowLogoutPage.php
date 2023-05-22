<?php

function ShowLogoutPage()
{
    global $LNG, $SESSION;

    $SESSION = new Session();
    $SESSION->DestroySession();

    $template   = new template();
    $template->cache    = true;
    $template->isPopup(true);
    $template->assign_vars(array(
        'lo_title'      => $LNG['lo_title'],
        'lo_logout'     => $LNG['lo_logout'],
        'lo_redirect'   => $LNG['lo_redirect'],
        'lo_notify'     => $LNG['lo_notify'],
        'lo_continue'   => $LNG['lo_continue'],
    ));
    $template->show("logout_overview.tpl");
}
