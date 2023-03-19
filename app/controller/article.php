<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Comment.php';

session_start();
// if (!isset($_GET['id'])) {
    // header('Location: blog.html');
    // die();
// }

if (isset($_POST['submit-comment'])) {
    $add_comment = new Comment();

    $content = htmlspecialchars(trim($_POST['comment-content']), ENT_QUOTES);
    $article_id = htmlspecialchars(trim($_POST['article-id']), ENT_QUOTES);

    if (!empty($content) && !empty($article_id)) {
        $add_comment->setContent($content)
            ->setArticleId($article_id)
            ->setUserId($_SESSION['id']);

        if($add_comment->create()) {
            header("HTTP/1.1 201 Created");
            header('Refresh: 0; url=../../vue/src/article.php?id=' . $article_id);
            die();
        }
    }
}