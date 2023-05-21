<?php

define('INSIDE', true);
define('AJAX', true);

define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/');
require(ROOT_PATH . 'includes/common.php');
require(ROOT_PATH . 'includes/classes/class.template.php');

if (isset($_SESSION['USER'])) {
    $LANG->setUser($_SESSION['USER']['lang']);
} else {
    $LANG->GetLangFromBrowser();
}

$LANG->includeLang(array('FLEET', 'TECH'));

$RID    = request_var('raport', '');

/*if(file_exists(ROOT_PATH.'raports/raport_'.$RID.'.php'))
    require_once(ROOT_PATH.'raports/raport_'.$RID.'.php'); OLD CODE*/

$template   = new template();

#$template->isPopup(true); viejo
if (file_exists(ROOT_PATH . 'raports/raport_' . $RID . '.php')) {
    require_once(ROOT_PATH . 'raports/raport_' . $RID . '.php');
} else {
    $template->message($LNG['sys_raport_not_found'], 0, false, true);
    exit;
}

$template->isPopup(true);
$template->assign_vars(array('raport' => $raport));
$template->show('raport.tpl');
