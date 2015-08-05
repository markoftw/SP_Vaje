<?php

try{
    $mysqli = new PDO("mysql:host=localhost;dbname=oglasi;charset=utf8", "user", "password");
} catch (Exception $ex) {
    die("Error: " . $ex->getMessage());
}

?>
