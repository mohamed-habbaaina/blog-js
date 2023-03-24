<?php

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Category.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Article.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'User.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'includes'. DIRECTORY_SEPARATOR .'functions.php';

session_start();

// var_dump($_POST, $_SESSION);

// is user logged

// test 
if (!isset($_SESSION['id']) && !isset($_SESSION['role'])) {
    http_response_code(403);
    header('Location: article.php?id=' . $article->getId());
    die();
} else {
    $logged_user = new \User\User();

    // test if logged user still exists in database
    if (!$logged_user->isInDb($_SESSION['id'])) {
        $logged_user->deconnect();
        header('Location: ../../public/index.php');
        die();
    }

    $article = new Article();

    // check if id in $_GET is an integer
    if (preg_match('/^\d+$/', $_GET['id'])) {
        $article->setId($_GET['id']);
    } else {
        $article->setId(0);
    }

    // get article informations from database using id
    try {
        $article->get();
    } catch (Exception $e) {
        echo '<h1>' . $e->getMessage() . '</h1><a href="blog.php">retour au blog</a>';
        die();
    }

    if ($_SESSION['id'] === $article->getUserId() && $_SESSION['role'] === 'moderator' || $_SESSION['role'] === 'admin') {

        // categories from database used for select article category with select & option html elements
        $categories = Category::getAll();

        if (isset($_POST['submit'])) {
            $title = htmlspecialchars(trim($_POST['title']), ENT_QUOTES);
            $content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES);
            $category = htmlspecialchars(trim($_POST['category']), ENT_QUOTES);

            if (!empty($title) && !empty($content) && !empty($category)) {
                try {
                    // $article = new Article();

                    $file = $_FILES['image'];

                    // name image after last article created using user id
                    $name = 'article_thumbnail_' . $article->getId();

                    // set destination path to article thumbnail folder
                    $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'article_thumbnail' . DIRECTORY_SEPARATOR;

                    // required function get_image_file() to send image $file to $path and return its $name concatenated with its extension
                    $image = get_image_file($file, $name, $path);

                    if ($image !== null) {
                        $article->setImage($image);
                    } else {
                        $article->setImage($article->getImage());
                    }

                    $article->setTitle($title)
                        ->setContent($content)
                        ->setCategoryId($category);

                    if ($article->update()) {
                        header("HTTP/1.1 200 Updated");

                        header('Location: blog.php');
                        die(); //? useless die()?
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo 'erreur : veuillez remplir tous les champs';
            }
        }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../../public/style/edit.css">
    <script defer src="./../js/edit.js"></script>
    <title>Nouvel Article | Blog Cuisine</title>
</head>

<body>
    <?php require_once("./../includes/header.php") ?>

    <main>

        <form enctype="multipart/form-data" action="" method="post" id="formEditArticle">

            <h1>Modifier Article</h1>

            <label for="title">Titre</label>
            <input type="text" name="title" id="title" placeholder="Titre de votre article" value="<?= $article->getTitle() ?>">
            <small></small>

            <label for="category">Catégorie</label>
            <select name="category" id="category">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->getId() ?>" <?= $article->getCategoryId() === $category->getId() ? 'selected' : '' ?>><?= $category->getName() ?></option>
                <?php endforeach ?>
            </select>
            <small></small>

            <label for="content">Contenu</label>
            <textarea name="content" id="content" placeholder="Contenu de l'article" cols="30" rows="10"><?= $article->getContent() ?></textarea>
            <small></small>

            <?php if ($article->getImage() != null): ?>
                <img src="../../uploads/article_thumbnail/<?= $article->getImage() ?>" alt="article current image">
            <?php endif ?>
            <label for="image">Modifier l'image</label>
            <input type="file" name="image" id="image">
            <small></small>

            <button name="submit" type="submit">Publier les modifications</button>
        </form>

    </main>

    <?php require_once("./../includes/footer.php") ?>
</body>

</html>
<?php
    } else {
        http_response_code(403);
        header('Location: blog.php');
    }
}
