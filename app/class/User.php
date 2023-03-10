<?php
namespace User;
require_once('./DbConnection.php');
class User
{
    private ?string $username;
    private ?string $email;
    private ?string $password;
    private ?string $repass;
    private ?array $data;


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
        $data = \DbConnection::getDb()->prepare($requestCheck);
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

            $requestInsert = "INSERT INTO `utilisateurs` (`email`, `password`, `username`, `register_date`, `role`) VALUE (:email, :password, :username, now(), :role)";
            $request = \DbConnection::getDb()->prepare($requestInsert);
            $request->bindParam(':email', $email);
            $request->bindParam(':password', $password);
            $request->bindParam(':username', $username);
            $request->bindParam(':role', 'user');   // the default role is user
            $request->execute();

        endif;
    }
    
}
$user = new User();

var_dump($user->check_DB('mohamed'));