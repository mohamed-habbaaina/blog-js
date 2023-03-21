<?php
session_start();
require_once './../class/Profil.php';
$profil = new Profil();

if (isset($_POST['username'])){

    $username = $_SESSION['username'];

    //******* */ validation inputs HTML.
    // *********************************

    $new_username = $profil->isValid($_POST['username']);
    $password = $profil->isValid($_POST['password']);
    $repass = $profil->isValid($_POST['repass']);


    //****** */ validation inputs regExp.
    // **********************************
    
    // regExp valid username: strlen > 3, accept only [A-Za-z0-9].

    $regExpUsername = '/^[A-Za-z][A-Za-z0-9]{3,15}$/';

    if(preg_match($regExpUsername,$new_username)):
            
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

    
    // check the validity of inputs. 
    if ($validUsername === true && $validPassword === true && $password === $repass):

        $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
    
        //  Verify that the user has completed the entire form.
        if ($new_username && $password && $repass):

            if(empty($profil->check_DB($new_username)) || ($new_username === $username)):

                $profil->updateProfil($password, $new_username, $username);

                //  change status HTTP de 200 a 201
                header("HTTP/1.1 201 Profil Modifier !");

                $_SESSION['username'] = $new_username;

            endif;

        endif;

    endif;
}