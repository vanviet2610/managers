<?php
class Connection
{
    private static $instance = null, $connection = null;

    private function __construct($configs)
    {
        try {
            $dsn = "mysql:host=" . $configs['host'] . ';dbname=' . $configs['db'];
            return   self::$connection = new PDO($dsn, $configs['user'], $configs['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (Exception $err) {
            App::$app->loadError("database",  $err->getMessage());
            die();
        }
    }

    public static function getInstance($configs)
    {
        if (self::$instance == null) {
            new Connection($configs);
            self::$instance = self::$connection;
        }
        return self::$instance;
    }
}
