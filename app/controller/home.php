<?php

session_start();

require_once('./../class/Home.php');

// Get 3 last articles.

$articles = new Home();
$articles = $articles->getArticlHome();

echo json_encode($articles);