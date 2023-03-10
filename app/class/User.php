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
    
}
$user = new User();

var_dump($user->check_DB('mohamed'));