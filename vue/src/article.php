<?php
// require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'article.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Article.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Comment.php';

session_start();

// if (isset($_POST['submit-comment'])) {
//     $add_comment = new Comment();
    
//     $content = htmlspecialchars(trim($_POST['comment-content']), ENT_QUOTES);
//     $article_id = htmlspecialchars(trim($_POST['article-id']), ENT_QUOTES);

//     if (!empty($content) && !empty($article_id)) {
//         $add_comment->setContent($content)
//             ->setArticleId($article_id)
//             ->setUserId($_SESSION['id'])
//             ->create();
//     }

// }

// var_dump($_SESSION);

$article = new Article();

$article->setId($_GET['id']);

try {
    $article->get();
    // var_dump($article);
} catch (Exception $e) {
    echo '<h1>' . $e->getMessage() . '</h1>';
    die();
}

$comments = $article->getComments();

// var_dump($comments);
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

        <article>
            <h1><?= $article->getTitle() ?></h1>

            <p>Catégorie : <em><?= $article->getCategoryName() ?></em></p>

            <p>Article écrit par <b><?= $article->getAuthor() ? $article->getAuthor()['username'] : 'utilisateur supprimé' ?></b> le <?= $article->getCreationDate()->format('d/m/Y') ?> à <?= $article->getCreationDate()->format('H:i:s') ?></p>

            <p><?= $article->getContent() ?></p>

            <?php if ($article->getImage() !== null) : ?>
                <img src="data:image/jpeg;base64, <?= base64_encode($article->getImage()) ?>" alt="article image">
            <?php endif ?>
        </article>

        <?php if (isset($_SESSION['id'])): ?>
            <section id="new-comment">
                <form action="./../../app/controller/article.php" method="post">
                    <label for="comment-content">Ajouter un commentaire</label>
                    <textarea name="comment-content" id="comment-content" cols="30" rows="10"></textarea>
                    <input type="hidden" name="article-id" value="<?= $article->getId() ?>">
                    <button type="submit" name="submit-comment">Envoyer</button>
                </form>
            </section>
        <?php endif ?>

        <section id="comments">
            <?php foreach ($comments as $comment) : ?>
                <?php $author = $comment->getAuthor() ?>
                <div class="comment">
                    <p>Commentaire écrit par <b><?= $author ? $author['username'] : 'utilisateur supprimé' ?></b> le <?= $comment->getCreationDate()->format('d/m/Y') ?> à <?= $comment->getCreationDate()->format('H:i:s') ?></p>
                    <p><?= $comment->getContent() ?></p>
                </div>
            <?php endforeach ?>
        </section>

    </main>

    <?php require_once("./../includes/footer.php") ?>
</body>

</html>