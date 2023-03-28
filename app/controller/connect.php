<?php

session_start();

require_once './../class/User.php';
$user = new User\User();

if (isset($_POST['password']) && isset($_POST['username'])){

    //******* */ validation inputs HTML.
    // *********************************

    $username = $user->isValid($_POST['username']);
    $password = $user->isValid($_POST['password']);

    if($user->connection($username,$password)):

        // stored id and role in $_SESSIO
        $_SESSION['id'] = $user->getId($username);
        $_SESSION['role'] = $user->getRole($username);
        $_SESSION['username'] = $username;



        //  change statusText HTTP.
        header("HTTP/1.1 200 connected !");

    endif;


}