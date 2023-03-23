<?php
require_once dirname(__DIR__) . '/class/Article.php';
require_once dirname(__DIR__) . '/class/Category.php';
require_once dirname(__DIR__) . '/class/User.php';

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

function get_article_image_file($image_file)
{
    // test if file exists and has no error
    if (isset($image_file) && $image_file['error'] === 0) {

        // limit image size
        if ($image_file['size'] > 2000000) {
            throw new Exception('Taille de l\'image maximum : 2mo');
        } else {
            // get image infos
            $image_infos = pathinfo($image_file['name']);

            // get image extensions
            $image_extension = $image_infos['extension'];

            // accepted extensions array
            $extensions_array = ['png', 'gif', 'jpg', 'jpeg', 'webp'];

            if (in_array($image_extension, $extensions_array)) {
                // name image after last article created using user id
                $image_name = 'article_thumbnail_' . Article::getLastIdByUserId($_SESSION['id']) . '.' . $image_infos['extension'];

                // set path to article thumbnail folder
                $image_path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'article_thumbnail' . DIRECTORY_SEPARATOR . $image_name;

                // attempt to move image file to image folder
                if(move_uploaded_file($image_file['tmp_name'], $image_path)) {

                    // if successful, return image name to set it in Article instance, then at image column in articles table
                    return $image_name;
                }
            } else {

                // if the format is not accepted
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

        $image = get_article_image_file($_FILES['image']);

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
