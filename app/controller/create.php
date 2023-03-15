<?php

require_once dirname(__DIR__) . '/class/Article.php';
require_once dirname(__DIR__) . '/class/Category.php';

if (empty(trim($_POST['title']))) {
    throw new Exception('Le titre ne peut pas être vide.');
}

if (empty(trim($_POST['content']))) {
    throw new Exception('Le contenu ne peut pas être vide.');
}

if (empty(trim($_POST['category']))) {
    throw new Exception('Veuillez sélectionner une catégorie.');
}

$article = new Article();

// $article->setId(2);
$article->setTitle($_POST['title'])
    ->setContent($_POST['content'])
    ->setUserId(1)
    ->setCategoryId($_POST['category']);

$article->create();
