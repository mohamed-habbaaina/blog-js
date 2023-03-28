<?php

session_start();

require_once('./../class/User.php');

$user = new User\User();

if(!$user->isConnected()):
    header('location: ./../../public/index.php');
endif;

$user->deconnect();
header('location: ./../../public/index.php');
