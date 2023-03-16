<?php
require_once('./../../app/class/Admin.php');

$admin = new Admin();


/**
 * fetched the item data with the function file_get_contents().
 * ! the global variable $_POST did not work
 */
$data = json_decode(file_get_contents('php://input'), true);

// Create a default false response to be able to verify on the javascript side 
$respone = Array();
$respone['status'] = 400;

// verify if isser key 'username' and 'role' in HTPP.
if(isset($data['username']) && isset($data['role'])):

$username = $admin->isValid($data['username']);
$role = $admin->isValid($data['role']);

if($admin->getRole($username) !== 'admin'):
    header('location: ./../../pulic');
endif;

$admin->updateRole($username, $role);
$respone['status'] = 203;

endif;


// ? second method to solve the undate "GET"
// if(isset($_GET['username']) && isset($_GET['role'])):
    // echo json_encode(['test' => 'valeur test']);
    // $username = $_GET['username'];
    // $role = $_GET['role'];

// endif;


echo json_encode($respone);