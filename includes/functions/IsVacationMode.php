<?php

if (!defined('INSIDE')) {
    die('Hacking attempt!');
}

function IsVacationMode($CurrentUser)
{
    return ($CurrentUser['urlaubs_modus'] == 1) ? true : false;
}
