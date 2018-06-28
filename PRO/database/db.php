<?php
<<<<<<< HEAD
//Database vars
//optional, if using a log to track errors and login actions.
=======

>>>>>>> Jelle_1
define("DB_HOST", "localhost"); //definieer database locatie
define("DB_PORT", 3306);
define("DB_SOCKET", "");
define("DB_USER", "root"); // definieer database user
define("DB_PASSWORD", ""); //defnieer database wachtwoord

define("DB_NAME", "blog1"); //definieer database name


function connect() {
    try {
        $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
        $conn = new PDO($dsn, DB_USER, DB_PASSWORD, array(
            PDO::ATTR_PERSISTENT => true
        ));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("A database error was encountered: " . $e->getMessage());
    }
    return $conn;
}
