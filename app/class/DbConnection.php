<?php
// namespace User;
class DbConnection
{
    private static ?PDO $_db = null;

    private  $servername = 'localhost';
    private  $username_b = 'root';
    private  $password_b = '';
    private  $database = 'blog_js';
    private function __construct()
    {
        // singleton
    }

    public static function getDb()
    {

    // private $db;

    // public function __construct()
    // {
    //     try {
    //         $this->db = new \PDO("mysql:host=$this->servername;dbname=$this->database;charset=utf8", "$this->username_b", "$this->password_b");
    //     }
    //    catch(\PDOException $e){
    //         echo 'ERROR: ' . $e->getMessage();
    //    }
    // }

        
        if (!self::$_db) {
            try {
                // get database infos from ini file in config folder
                // $db = parse_ini_file('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'db.ini');
// 
                // self::$_db = new PDO($db['type'] . ':dbname=' . $db['name'] . ';host=' . $db['host'] . ';charset=utf8mb4', $db['user'], $db['password']);

                self::$_db = new PDO('mysql:host=self::localhost;dbname=self::blog_js;charset=utf8', 'self::root', 'self::');



                // self::$_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            return self::$_db;
        }
    }
}
