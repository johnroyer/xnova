<?php

define('INSIDE', true);
define('ROOT', true);
define('IN_ADMIN', true);
define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

require(ROOT_PATH . 'includes/common.php');
$LANG->includeLang(array('ADMIN'));

if (isset($_REQUEST['admin_pw'])) {
        $login = $db->uniquequery("SELECT `id`, `username`, `dpath`, `authlevel`, `id_planet` FROM " . USERS . " WHERE `id` = '1' AND `password` = '" . md5($_REQUEST['admin_pw']) . "';");
    if (isset($login)) {
            session_start();
            $SESSION        = new Session();
            $SESSION->CreateSession($login['id'], $login['username'], $login['id_planet'], $UNI, $login['authlevel'], $login['dpath']);
            $_SESSION['admin_login']        = md5($_REQUEST['admin_pw']);
            redirectTo('admin.php');
    }
}
$template       = new template();

$template->assign_vars(array(
    'adm_login'                     => $LNG['adm_login'],
    'adm_password'                  => $LNG['adm_password'],
    'adm_absenden'                  => $LNG['adm_absenden'],
));
$template->show('adm/LoginPage.tpl');
