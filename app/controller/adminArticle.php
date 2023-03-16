<?php

require_once('./../../app/class/Admin.php');

$admin = new Admin();
$data = $admin->getAllArticles();
echo (json_encode($data));