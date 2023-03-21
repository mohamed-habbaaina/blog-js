<?php
namespace User;

use DbConnection;

// use DbConnection;

// var_dump(__DIR__);
require_once 'DbConnection.php';

class User
{
    private ?string $username;
    private ?string $email;
    private ?string $password;
    private ?string $repass;
    private ?int $id;
    private ?array $data;

    // La DB.
    private $servername = 'localhost';
    private $username_b = 'root';
    private $password_b = '';
    private $database = 'blog_js';
    private $db;

    public function __construct()
    {
    //     try {
    //         $this->db = new \PDO("mysql:host=$this->servername;dbname=$this->database;charset=utf8", "$this->username_b", "$this->password_b");
    //     }
    //    catch(\PDOException $e){
    //         echo 'ERROR: ' . $e->getMessage();
    //    }
    }

    /**
     * method of securing inputs
     * @return string.
     */
    public function isValid(string $input): string
    {

        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = strip_tags($input);

        return $input;
    }

    /**
     * Check DB where username = 
    * @return ?array[0]["$data"]
    */
    public function check_DB($username): ?array
    {

        $requestCheck = "SELECT * FROM `users` WHERE username=:username";
        $data = \DbConnection::getDb()->prepare($requestCheck);
        $data->bindParam(':username', $username);
        $data->execute();
        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Register the user in the database.
     */
    public function register($email, $username, $password): void
    {

        if(empty($this->check_DB($username))):

            $requestInsert = "INSERT INTO `users` (`email`, `password`, `username`, `register_date`, `role`) VALUE (:email, :password, :username, NOW(), 'user')";
            $request = \DbConnection::getDb()->prepare($requestInsert);
            $request->bindParam(':email', $email);
            $request->bindParam(':password', $password);
            $request->bindParam(':username', $username);
            $request->execute();

        endif;
    }

    // public function check_DB_connect($email)
    // {
    //     $requestCheckEmail = "SELECT * FROM `users` WHERE email=:email";
    //     $data = \DbConnection::getDb()->prepare($requestCheckEmail);
    //     $data->bindParam(':email', $email);
    //     $data->execute();
    //     return $data->fetchAll(\PDO::FETCH_ASSOC);

    // }

    /**
     * method for connecting the user.
     * @return  true,false
     */

    public function connection($username, $password): bool
    {

        $data = $this->check_DB($username);

        if(!empty($data)):

            $password_db = $data[0]['password'];
            
                // verifier le password Haché.
                if (password_verify($password, $password_db)):
                  
                    return true;
                else:
                     return false;
                endif;
            else:
                return false;
        endif;
    }

    // ** GETTERS: ID & Role

    /**
     * getter id
     * @return int
     */
    public function getId($username): int
    {
        $data = $this->check_DB($username);

        return $data[0]['id'];
    }

        /**
     * getter Role
     * @return string
     */
    public function getRole($username): string
    {
        $data = $this->check_DB($username);

        return $data[0]['role'];
    }

    /**
    * @return true,false
    */
    public function isConnected(): bool
    {
        if(isset($_SESSION['role'])):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * Destroy all variables of the current session, and Destroy the current session
     */
    public function deconnect(): void
    {
        $_SESSION = array(); 
        session_unset();
        session_destroy();
    }

    /**
     * check if user is in database
     * can be used to test if logged user still exists in database
     * @param int $id representing user id
     * @return boolean, depending if the query find the user
     */
    public function isInDb(int $id): bool {
        $sql = 'SELECT COUNT(id) FROM users WHERE id = :id';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':id', $id, \PDO::PARAM_INT);

        $select->execute();

        return $select->fetchColumn() > 0;
    }
}
