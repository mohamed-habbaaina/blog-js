<?php

require_once('DbConnection.php');
require_once('User.php');

class Profil extends \User\User {

    public function updateProfil($password, $new_username, $username): void
    {
        if(empty($this->check_DB($new_username)) || $new_username === $username):

            $qerProf = "UPDATE `users` SET password=:password,username=:new_username WHERE username=:username";
            $querProfil = DbConnection::getDb()->prepare($qerProf);
            $querProfil->bindParam(':password', $password);
            $querProfil->bindParam(':new_username', $new_username);
            $querProfil->bindParam(':username', $username);
            $querProfil->execute();


        endif;
    }
}