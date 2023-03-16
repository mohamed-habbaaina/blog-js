<?php
require_once dirname(__DIR__) . '/class/Article.php';
require_once dirname(__DIR__) . '/class/Category.php';

session_start();

$title = htmlspecialchars(trim($_POST['title']), ENT_QUOTES);
$content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES);
$category = htmlspecialchars(trim($_POST['category']), ENT_QUOTES);

// var_dump($title, $content, $category);

if (!empty($title) && !empty($content) && !empty($category)) {
    $article = new Article();

    $article->setTitle($title)
        ->setContent($content)
        ->setCategoryId($category)
        ->setUserId($_SESSION['id']);

    if ($article->create()) {
        header("HTTP/1.1 201 Created");
        header('Refresh: 0; url=../../vue/src/blog.php');
        die();
    }
} else {
    echo 'erreur : veuillez remplir tous les champs';
}
