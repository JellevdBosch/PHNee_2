<?php

define("DB_HOST", "localhost"); //definieer database locatie
define("DB_PORT", 3306);
define("DB_SOCKET", "");
define("DB_USER", "root"); // definieer database user
define("DB_PASSWORD", ""); //defnieer database wachtwoord

define("DB_NAME", "blog1"); //definieer database name


function connect() {
    try {
        // Create connection
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    } catch (PDOException $e) {
        die("A database error was encountered: " . $e->getMessage());
    }
    return $conn;
}
