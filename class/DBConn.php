<?php

abstract class DBConn
{
    public static function getConn(): PDO
    {
        $servername = "localhost";
        $username = "root";
        $pass = "";
        $dbname = "test";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
    }

    public static function fixId(string $class, string $className) : void
    {
        $pdo = DBConn::getConn();
        $m = new $class();
        $mArr = $m->getAllAsObjects();
        $countArr = count($mArr) + 1;
        $stmt = $pdo->query("ALTER TABLE $class auto_increment = {$countArr}");
        $stmt->execute();
    }
}