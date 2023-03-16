<?php
require_once('./../../app/class/Admin.php');

$admin = new Admin();
$data = $admin->getAllUsers();
echo (json_encode($data));