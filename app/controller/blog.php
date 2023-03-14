<?php

require_once('./../class/User.php');

$user = new User\User();

if(!$user->isConnected()){
    header('location: ./../../public/index.php');
    die;
}
require_once('./../class/Blog.php');


$blog = new Blog();
$dataBlog = $blog->getBlog();
echo (json_encode($dataBlog));
