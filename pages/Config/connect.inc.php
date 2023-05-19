<?php

function connect()
{
    require_once("config.inc.php");
    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $login, $password);
        //echo "Connexion etablie...<br>";
        return $conn;
    } catch(PDOException $e) {
        echo "Probleme de connexion :".$e->getMessage()."...<br>";
        die();
    }
}