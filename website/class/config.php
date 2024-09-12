<?php

$ip_usuario = $_SERVER["HTTP_X_REAL_IP"];

define('DB_HOST', $ip_usuario);
//
define('DB_PORT', '3306');
define('DB_NAME', 'skins');
define('DB_USER', 'skinchanger');
define('DB_PASS', 'skinchanger');

define('WEB_STYLE_DARK', true);

define('STEAM_API_KEY', 'F20560C830F8E6B3243B0BDDE68F076C');
define('STEAM_DOMAIN_NAME', $ip_usuario);
define('STEAM_LOGOUT_PAGE', 'index.php');
define('STEAM_LOGIN_PAGE', 'index.php');

