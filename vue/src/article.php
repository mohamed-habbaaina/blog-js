<?php

if (!isset($_GET['id'])) {
    header('Location: blog.php');
    die();
}

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

$article = new Article();


if (preg_match('/^\d+$/', $_GET['id'])) {
    $article->setId($_GET['id']);
} else {
    $article->setId(0);
}

try {
    $article->get();
} catch (Exception $e) {
    echo '<h1>' . $e->getMessage() . '</h1><a href="blog.php">retour au blog</a>';
    die();
}

$comments = $article->getComments();

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

        <div class="container">

                    <article>
                        <p id="category">Catégorie : <em><?= $article->getCategoryName() ?></em></p>

                        <h1><?= $article->getTitle() ?></h1>

                        <?php
                        // edit button
                        if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
                            if ($_SESSION['id'] === $article->getUserId() && $_SESSION['role'] === 'moderator' || $_SESSION['role'] === 'admin') {
                                echo '<a class="btn" href="edit_article.php?id='. $article->getId() .'" id="edit-btn">Éditer</a>';
                            }
                        }
                        ?>


                        <p id="author">Article écrit par <b><?= $article->getAuthor() ? $article->getAuthor()['username'] : 'utilisateur supprimé' ?></b> le <?= $article->getCreationDate()->format('d/m/Y') ?> à <?= $article->getCreationDate()->format('H:i:s') ?></p>

                        <?php if ($article->getImage() !== null) : ?>
                            <div id="main-img"><img src="../../uploads/article_thumbnail/<?= $article->getImage() ?>" alt="article image"></div>
                        <?php endif ?>
                        
                        <p id="content"><?= $article->getContent() ?></p>
                    </article>

                    <?php if (isset($_SESSION['id'])): ?>
                        <section id="new-comment">
                            <form action="./../../app/controller/article.php" method="post">
                                <label for="comment-content">Ajouter un commentaire</label>
                                <textarea name="comment-content" id="comment-content" cols="50" rows="5"></textarea>
                                <input type="hidden" name="article-id" value="<?= $article->getId() ?>">
                                <button class="btn" type="submit" name="submit-comment">Commenter</button>
                            </form>
                        </section>
                    <?php endif ?>

                    <section id="comments">
                        <h2>Commentaires</h2>
                        <?php foreach ($comments as $comment) : ?>
                            <?php $author = $comment->getAuthor() ?>
                            <div class="comment">
                                <p>Commentaire écrit par <b><?= $author ? $author['username'] : '<i>utilisateur supprimé</i>' ?></b> le <?= $comment->getCreationDate()->format('d/m/Y') ?> à <?= $comment->getCreationDate()->format('H:i:s') ?></p>
                                <p class="content"><?= $comment->getContent() ?></p>

                                <?php
                                // for logged users only
                                if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
                                    $delete_button = '<form class="delete-com" action="./../../app/controller/article.php" method="post"><button class="btn small" type="submit" name="delete-comment" value="' . $comment->getId() . '">Delete Comment</button></form>';
                                    // authors can delete theirs comments
                                    if ($author['id'] === $_SESSION['id']) {
                                        echo $delete_button;
                                    } else {
                                        switch ($_SESSION['role']) {
                                            // admin can do anything
                                            case 'admin':
                                                echo $delete_button;
                                                break;

                                            case 'moderator':
                                                // mods can delete basic users comments
                                                if ($author['role'] !== 'admin' && $author['role'] !== 'moderator') {
                                                    echo $delete_button;
                                                }
                                                break;
                                        }
                                    }
                                }
                                ?>

                            </div>
                        <?php endforeach ?>
                    </section>

        </div>

    </main>

    <?php require_once("./../includes/footer.php") ?>
</body>

</html>