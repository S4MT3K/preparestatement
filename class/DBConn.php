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

    public static function fixId() : void
    {
        $pdo = DBConn::getConn();
        $m = new Mitarbeiter();
        $mArr = $m->getAllMitarbeiterAsObjects();
        $countArr = count($mArr) + 1;
        $stmt = $pdo->query("ALTER TABLE mitarbeiter auto_increment = {$countArr}");
        $stmt->execute();
    }
}