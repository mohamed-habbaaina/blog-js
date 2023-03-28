<?php

session_start();

require_once './../class/User.php';

$user = new User\User();

if (isset($_POST['password'])){

    //******* */ validation inputs HTML.
    // *********************************

    $username = $user->isValid($_POST['username']);
    $email = $user->isValid($_POST['email']);
    $password = $user->isValid($_POST['password']);
    $repass = $user->isValid($_POST['repass']);


    //****** */ validation inputs regExp.
    // **********************************
    
    // regExp valid username: strlen > 3, accept only [A-Za-z0-9].

    $regExpUsername = '/^[A-Za-z][A-Za-z0-9]{3,15}$/';

    if(preg_match($regExpUsername,$username)):
            
        $validUsername = true;
    else:
        $validUsername = false;

    endif;

    // regExp valid Password: strlen >4, accept only [A-Za-z0-9] && minimum 1 lower case 1 upper case 1 number.

    $regExpPass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,}$/';

    if(preg_match($regExpPass,$password)):
            
        $validPassword = true;
    else:
        $validPassword = false;

    endif;

    
    // regExp valid Email.

    $regExpEmail = '/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-z]{2,5})$/'; 

    if(preg_match($regExpEmail, $email)):

        $validEmail = true;

    else:

        $validEmail = false;

    endif;


    // check the validity of inputs. 
    if ($validUsername === true && $validPassword === true && $validEmail === true && $password === $repass):

        $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
    
        //  Verify that the user has completed the entire form.
        if ($email && $username && $password && $repass):

            if(empty($user->check_DB($username))):

                $user->register($email, $username, $password);

                //  change status HTTP de 200 a 201
                header("HTTP/1.1 201 Compte Enregistrer");

                $_SESSION['username'] = $username;

            endif;

        endif;

    endif;
}