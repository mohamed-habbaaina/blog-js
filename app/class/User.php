<?php
namespace User;
// require_once('./DbConnection.php');
class User
{
    private ?string $username;
    private ?string $email;
    private ?string $password;
    private ?string $repass;
    private ?array $data;

    // La DB.
    private $servername = 'localhost';
    private $username_b = 'root';
    private $password_b = '';
    private $database = 'blog_js';
    private $db;

    public function __construct()
    {
        try {
            $this->db = new \PDO("mysql:host=$this->servername;dbname=$this->database;charset=utf8", "$this->username_b", "$this->password_b");
        }
       catch(\PDOException $e){
            echo 'ERROR: ' . $e->getMessage();
       }
    }

    /**
     * method of securing inputs
     * @return string.
     */
    public function isValid(string $input)
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
    public function check_DB($username)
    {

        $requestCheck = "SELECT * FROM `users` WHERE username=:username";
        $data = $this->db->prepare($requestCheck);
        $data->bindParam(':username', $username);
        $data->execute();
        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Register the user in the database.
     */
    public function register($email, $username, $password)
    {

        if(empty($this->check_DB($username))):

            $requestInsert = "INSERT INTO `users` (`email`, `password`, `username`, `register_date`, `role`) VALUE (:email, :password, :username, now(), 'user')";
            $request = $this->db->prepare($requestInsert);
            $request->bindParam(':email', $email);
            $request->bindParam(':password', $password);
            $request->bindParam(':username', $username);
            $request->execute();
            
        endif;
    }

    public function check_DB_connect($email)
    {
        $requestCheckEmail = "SELECT * FROM `users` WHERE email=:email";
        $data = $this->db->prepare($requestCheckEmail);
        $data->bindParam(':email', $email);
        $data->execute();
        return $data->fetchAll(\PDO::FETCH_ASSOC);

    }
    
}
$user = new \User\User();
var_dump($user->check_DB_connect('mohamed.habbaaina@laplateforme.io'));
echo '<br>';
// var_dump($user->check_DB('TOTO'));
// var_dump($user->register('mohamed@ghj.hb', 'mohaa', 'mohamed'));