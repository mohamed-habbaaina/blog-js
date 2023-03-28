<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Article.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Category.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'User.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR .'vue'. DIRECTORY_SEPARATOR .'includes'. DIRECTORY_SEPARATOR .'functions.php';

session_start();

$logged_user = new \User\User();

if (!$logged_user->isInDb($_SESSION['id'])) {
    $logged_user->deconnect();
    header('Location: ../../public/index.php');
    die();
}

$title = htmlspecialchars(trim($_POST['title']), ENT_QUOTES);
$content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES);
$category = htmlspecialchars(trim($_POST['category']), ENT_QUOTES);



if (!empty($title) && !empty($content) && !empty($category)) {
    try {
        $article = new Article();

        $file = $_FILES['image'];

        // name image after last article created using user id
        $name = 'article_thumbnail_' . Article::getLastIdByUserId($_SESSION['id']);

        // set destination path to article thumbnail folder
        $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'article_thumbnail' . DIRECTORY_SEPARATOR;

        // required function get_image_file() to send image $file to $path and return its $name concatenated with its extension
        $image = get_image_file($file, $name, $path);

        if ($image !== null) {
            $article->setImage($image);
        } else {
            // $article->setImage($article->getImage());
        }

        $article->setId($_SESSION['last-seen-article'])
            ->setTitle($title)
            ->setContent($content)
            ->setCategoryId($category)
            ->setUserId($_SESSION['id']);

        if ($article->update()) {
            header("HTTP/1.1 201 Created");
            header('Refresh: 0; url=../../vue/src/blog.php');
            die();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo 'erreur : veuillez remplir tous les champs';
}
