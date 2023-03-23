<?php
require_once('./../class/Home.php');

if(isset($_GET['search'])):

    $request = $_GET['search'];

    $home = new Home();

    $data = $home->getSearchArticle($request);

    echo json_encode($data);

endif;