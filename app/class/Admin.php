<?php

require_once('DbConnection.php');
require_once('User.php');

class Admin extends \User\User {
private ?array $data;


public function getAllUsers(){
    $reqAllUsers = "SELECT * FROM `users`";
    $dataAllUsers = DbConnection::getDb()->prepare($reqAllUsers);
    $dataAllUsers->execute();
    return $dataAllUsers->fetchAll(PDO::FETCH_ASSOC);
}

public function getUsername($username)
{

    return  $this->check_DB($username)[0]['username'];
    
}

public function getResisterDate($username)
{
    return  $this->check_DB($username)[0]['register_date'];

}


}