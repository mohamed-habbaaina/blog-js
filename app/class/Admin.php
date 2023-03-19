<?php

require_once('DbConnection.php');
require_once('User.php');

class Admin extends \User\User {
private ?array $data;

/**
 * Get all users
 */
public function getAllUsers(): array
{
    $reqAllUsers = "SELECT * FROM `users`";
    $dataAllUsers = DbConnection::getDb()->prepare($reqAllUsers);
    $dataAllUsers->execute();
    return $dataAllUsers->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Delete user
 */
public function deleteUser($username): void
{
    $reqDe = "DELETE FROM `users` WHERE username=:username";
    $reqDelete = DbConnection::getDb()->prepare("$reqDe");
    $reqDelete->bindParam(":username", $username);
    $reqDelete->execute();


}

/**
 * Get all articles order by date
 */
public function getAllArticles(): array
{
    $reqArtcl = "SELECT title, creation_date, username, articles.id FROM `articles` INNER JOIN `users` ON users.id = articles.user_id ORDER BY creation_date DESC";
    $dataArticl = DbConnection::getDb()->prepare("$reqArtcl");
    $dataArticl->execute();
    return $dataArticl->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Delete article.
 */
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
    $req = "UPDATE `users` SET `role`=:role WHERE username=:username";
    $reqRole = DbConnection::getDb()->prepare("$req");
    $reqRole->bindParam(':username', $username);
    $reqRole->bindParam(':role', $role);
    $reqRole->execute();

}
/**
 * insert into categoties
 */
public function insertCaregory(string $name, string $description) : void
{
    $reqIns = "INSERT INTO `categories`(`name`, `description`) VALUES (:name, :description)";
    $reqInserCategory = DbConnection::getDb()->prepare("$reqIns");
    $reqInserCategory->bindParam(':name', $name);
    $reqInserCategory->bindParam(':description', $description);
    $reqInserCategory->execute();
}

public function validText($text)
{
    $text = trim($text);
    $text = htmlspecialchars($text);
    return DbConnection::getDb()->quote($text);

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

$admin = new Admin();

// var_dump($admin->validText('allo <br>'));
// echo '<br>';
// var_dump($admin->validText('allo c\'est moi'));
