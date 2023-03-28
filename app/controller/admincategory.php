<?php

require_once('./../class/Admin.php');

$admin = new Admin();
$response = array();
$response['status'] = 400;

$data = json_decode(file_get_contents('php://input'), true);

if(isset($data['namecategorie']) && isset($data['description'])):

    $name = $data['namecategorie'];
    $description = $data['description'];

    $admin->insertCaregory($name, $description);

    $response['status'] = 201;

endif;

echo (json_encode($response));