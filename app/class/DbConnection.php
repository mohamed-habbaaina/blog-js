<?php

class DbConnection
{
    private static ?PDO $_db = null;

    private function __construct()
    {
        // singleton
    }

    public static function getDb()
    {
        
        if (!self::$_db) {
            try {
                // get database infos from ini file in config folder
                $db = parse_ini_file('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'db.ini');

                self::$_db = new PDO($db['type'] . ':dbname=' . $db['name'] . ';host=' . $db['host'] . ';charset=utf8mb4', $db['user'], $db['password']);

                self::$_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            return self::$_db;
        }
    }
}
