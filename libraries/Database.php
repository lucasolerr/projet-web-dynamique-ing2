<?php

class Database
{
    private static $instance = null;

    public static function getPdo(): \PDO
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO('mysql:host=localhost;dbname=omnesbox;charset=utf8', 'root', 'root', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                // Log the exception to a file or output it to the browser
                // for debugging purposes
                error_log($e->getMessage());
                throw $e;
            }
        }

        return self::$instance;
    }
}
