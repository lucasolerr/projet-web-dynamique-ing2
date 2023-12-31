<?php

class Database
{
    private static $instance = null;

    public static function getPdo(): \PDO
    {
        if(self::$instance === null){
            self::$instance = new PDO('mysql:host=localhost;dbname=dbomnesbox;charset=utf8', 'root', 'root', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }

        return self::$instance;
    }
}
