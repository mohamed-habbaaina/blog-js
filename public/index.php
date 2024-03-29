<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../public/style/style.css">
    <link rel="stylesheet" href="./../public/style/home.css">
    <script defer src="./../vue/js/home.js"></script>
    <title>Accueil | Blog Cuisine</title>
</head>
<body>

    <header>
        <a href="../../public/index.php" id="header-icon"><img src="img/chef.png" alt="icone site chef"></a>
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="../vue/src/blog.php">Blog</a></li>

                <?php if(isset($_SESSION['role'])): // for logged users ?>

                    <?php if($_SESSION['role'] === 'admin'): // for admins ?>

                        <li><a href="../vue/src/admin.php">Admin</a></li>

                    <?php endif ?>

                    <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'moderator'): // for admins & moderators ?>

                        <li><a href="../vue/src/create.php">Écrire un article</a></li> 

                    <?php endif // for other logged users ?>

                    <li><a href="../vue/src/profil.php">Profil</a></li>

                    <li><a href="../app/controller/deconnect.php">Déconnexion</a></li>

                <?php else: // for guests ?>

                    <li><a href="../vue/src/connect.php">Connexion</a></li>
                    
                    <li><a href="../vue/src/register.php">Inscription</a></li>

                <?php endif ?>

            </ul>
        </nav>
    </header>

    <main>

        <div class="container">
            <section class="headerSearch">
                <div>
                    <h1>Blog Cuisine Méditerranéenne</h1>
                    <p>
                        Bienvenue sur notre blog dédié à la cuisine méditerranéenne ! Une cuisine saine et délicieuse, façonnée au fil des siècles par les cultures et les traditions des pays bordant la mer Méditerranée : la maghrébine, l’italienne, l’égyptienne, la levantine, la turque, la grecque, la provençale, la chypriote, la maltaise, l’espagnole, la libanaise, la portugaise...
                    </p>
                    <p>
                        La cuisine méditerranéenne est caractérisée par l'utilisation d'ingrédients frais et simples, tels que les légumes, les fruits, les olives, les herbes aromatiques et les poissons. En plus d'être délicieuse, cette cuisine a de nombreux bienfaits pour la santé, car elle est riche en nutriments et en antioxydants.
                    </p>
                    <p>
                        Nous sommes passionnés par la cuisine méditerranéenne et nous sommes heureux de partager avec vous nos recettes, nos astuces et nos conseils pour vous aider à découvrir cette cuisine merveilleuse et à l'apprécier à sa juste valeur.
                    </p>
                </div>
                <div>
                    <!-- Le formulaire de recherche -->
                    <form action="../vue/src/article.php?id=" id="formSearch">
                        <input type="search" name="search" id="search" placeholder="Rechercher un Article ...">
                    </form>
                    <!-- L'affichage des resultats -->
                    <ul id="result"></ul>
                </div>
            </section>
    
            <section class="articlHome">
            </section>
        </div>

    </main>

    <?php require_once('./../vue/includes/footer.php'); ?>
</body>
</html>