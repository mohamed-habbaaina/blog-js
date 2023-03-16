<?php

require_once('DbConnection.php');
require_once('User.php');

class Admin extends \User\User {
private ?array $data;


public function getAllUsers(): array
{
    $reqAllUsers = "SELECT * FROM `users`";
    $dataAllUsers = DbConnection::getDb()->prepare($reqAllUsers);
    $dataAllUsers->execute();
    return $dataAllUsers->fetchAll(PDO::FETCH_ASSOC);
}

public function deleteUser($username): void
{
    $reqDe = "DELETE FROM `users` WHERE username=:username";
    $reqDelete = DbConnection::getDb()->prepare("$reqDe");
    $reqDelete->bindParam(":username", $username);
    $reqDelete->execute();


}

public function getAllArticles(): array
{
    $reqArtcl = "SELECT title, creation_date, username, articles.id FROM `articles` INNER JOIN `users` ON users.id = articles.user_id";
    $dataArticl = DbConnection::getDb()->prepare("$reqArtcl");
    $dataArticl->execute();
    return $dataArticl->fetchAll(PDO::FETCH_ASSOC);
}

public function deleteArticle(int $id) : void
{
    $reqDeAr = "DELETE FROM `articles` WHERE id=:id";
    $reqDelArticle = DbConnection::getDb()->prepare($reqDeAr);
    $reqDelArticle->bindParam(':id', $id);
    $reqDelArticle->execute();
}

/**
 * update the user's role
 */
public function updateRole(string $username, string $role): void
{
    $req = "UPDATE `users` SET `role`=':role' WHERE username=:username";
    $reqRole = DbConnection::getDb()->prepare("$req");
    $reqRole->bindParam(':username', $username);
    $reqRole->bindParam(':role', $role);
    $reqRole->execute();

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