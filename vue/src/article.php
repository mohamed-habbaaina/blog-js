<?php 
require_once './../../app/controller/article.php';

$comments = $article->getComments();

var_dump($comments);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../../public/style/style.css">
    <link rel="stylesheet" href="./../../public/style/article.css">
    <script defer src="./../js/article.js"></script>
    <title><?= $article->getTitle() ?> | Blog Cuisine</title>
</head>
<body>
    <?php require_once("./../includes/header.php") ?>

    <main>

        <h1><?= $article->getTitle() ?></h1>
        <p>Catégorie : <em><?= $article->getCategoryName() ?></em></p>
        <p>Écrit par <b><?= $article->getAuthor()['username'] ?></b> le <?= $article->getCreationDate()->format('d/m/Y') ?> à <?= $article->getCreationDate()->format('H:i:s') ?></p>
        <p><?= $article->getContent() ?></p>
        <img src="data:image/jpeg;base64, <?= base64_encode($article->getImage()) ?>" alt="article image">

    </main>

    <?php require_once("./../includes/footer.php") ?>
</body>
</html>