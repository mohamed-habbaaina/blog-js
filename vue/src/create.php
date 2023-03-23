<?php

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Category.php';

session_start();

// var_dump($_POST, $_SESSION);

if (!isset($_SESSION['id'])) {
    http_response_code(403);
    header('Location: connect.php');
    die();
} elseif ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'moderator') {
    http_response_code(403);
    header('Location: blog.php');
    die();
}

// categories from database used for select article category with select & option html elements
$categories = Category::getAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../../public/style/create.css">
    <script defer src="./../js/create.js"></script>
    <title>Nouvel Article | Blog Cuisine</title>
</head>
<body>
    <?php require_once("./../includes/header.php") ?>

    <main>

        <form enctype="multipart/form-data" action="./../../app/controller/create.php" method="post" id="formCreateArticle">

            <h1>Nouvel Article</h1>

            <label for="title">Titre</label>
            <input type="text" name="title" id="title" placeholder="Titre de votre article">
            <small></small>

            <label for="category">Catégorie</label>
            <select name="category" id="category">
                <option value="">-- Sélectionnez la Catégorie --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                <?php endforeach ?>
            </select>
            <small></small>

            <label for="content">Contenu</label>
            <textarea name="content" id="content" placeholder="Contenu de l'article" cols="30" rows="10"></textarea>
            <small></small>

            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            <small></small>

            <button name="submit" type="submit">Publier</button>
        </form>

    </main>

    <?php require_once("./../includes/footer.php") ?>
</body>
</html>