<?php
require_once dirname(__DIR__) . '/class/Article.php';
require_once dirname(__DIR__) . '/class/Category.php';

session_start();

$title = htmlspecialchars(trim($_POST['title']), ENT_QUOTES);
$content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES);
$category = htmlspecialchars(trim($_POST['category']), ENT_QUOTES);

function get_image_file($image_file)
{
    // var_dump($image_file);
    if (isset($image_file) && $image_file['error'] === 0) {

        if ($image_file['size'] > 2000000) {
            throw new Exception('Taille de l\'image maximum : 2mo');
        } else {
            $image_file = $_FILES['image'];

            $image_infos = pathinfo($image_file['name']);

            $image_extension = $image_infos['extension'];

            $extensions_array = ['png', 'gif', 'jpg', 'jpeg', 'webp'];

            if (in_array($image_extension, $extensions_array)) {
                $image_name = 'article_thumbnail_' . Article::getLastIdByUserId($_SESSION['id']) . '.' . $image_infos['extension'];
                $image_path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'article_thumbnail' . DIRECTORY_SEPARATOR . $image_name;

                if(move_uploaded_file($image_file['tmp_name'], $image_path)) {
                    return $image_name;
                }
            } else {
                $extensions_string = '';

                foreach ($extensions_array as $key => $extension) {
                    if ($key === array_key_last($extensions_array)) {
                        $extensions_string .= $extension;
                    } else {
                        $extensions_string .= $extension . ', ';
                    }
                }
                throw new Exception('Format du fichier non accepté. Formats acceptés : ' . $extensions_string);
            }
        }
    }
}

if (!empty($title) && !empty($content) && !empty($category)) {
    try {
        $article = new Article();
    
        $image = get_image_file($_FILES['image']);

        $article->setTitle($title)
            ->setContent($content)
            ->setImage($image)
            ->setCategoryId($category)
            ->setUserId($_SESSION['id']);

        if ($article->create()) {
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
