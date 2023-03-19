<?php
session_start();
require_once('./../class/Blog.php');

// Get the page number stored in the global session variable, and use it for paging 'OFFSET'.

$page = isset($_SESSION['page']) ? (int)$_SESSION['page'] : 1;

// get 6 items per page.
$numberArticl = 6;
$offset = ($page - 1) * $numberArticl;


$blog = new Blog();
$dataBlog = $blog->getBlog($offset);

echo json_encode($dataBlog);