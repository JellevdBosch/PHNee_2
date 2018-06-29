<?php
ob_start();
session_start();

date_default_timezone_set('Europe/Amsterdam');
define ('DEVELOPMENT_ENVIRONMENT',true);

/** Configuration Variables **/
if (DEVELOPMENT_ENVIRONMENT){
    define ('SITE_ROOT' , 'http://php-2-1.local/');
}else{
    define ('SITE_ROOT' , 'http://php-2-1.local/'); //definieer live omgeving root
}

define('DS', '/');
define ('SITE_TITLE', "Taken Blog"); // definieeer site naam

define('DEFAULT_DIR', 'posts');
define('DEFAULT_ACTION', '');

//Database vars
//optional, if using a log to track errors and login actions.
define("DB_HOST", "localhost"); //definieer database locatie
define("DB_PORT", 3306);
define("DB_SOCKET", "");
define("DB_USER", "root"); // definieer database user
define("DB_PASSWORD", ""); //defnieer database wachtwoord

define("DB_NAME", "blog1"); //definieer database name

define("ACCOUNT_USERNAME", "JELLE");
define("ACCOUNT_PASSWORD", "JELLE");
?>