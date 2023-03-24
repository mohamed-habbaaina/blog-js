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
        <a href="#">LOGO</a>
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

        <section class="headerSearch">
            <div>
                <h1>Blog Cuisine Méditerranéenne</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing totam temporibus illum ea rem quis accusamus consequuntur dolorem cumque, corporis dolor deserunt natus fugiat, similique alias. Dolorum repellat voluptates temporibus recusandae nisi ipsa dolore esse quisquam ullam.</p>
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

    </main>

    <?php require_once('./../vue/includes/footer.php'); ?>
</body>
</html>