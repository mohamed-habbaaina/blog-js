<?php

// if (!isset($_GET['id'])) {
    // header('Location: blog.html');
    // die();
// }

require_once dirname(__DIR__) . '/class/Article.php';


$article = new Article();
$article->setId($_GET['id']);

try {
    $article->get();
    // var_dump($article);
} catch (Exception $e) {
    echo '<h1>' . $e->getMessage() . '</h1>';
    die();
}
