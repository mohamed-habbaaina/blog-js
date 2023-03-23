<?php
session_start();
if(isset($_SESSION['role'])):
    
    $role = $_SESSION['role'];

    if($role === 'admin'):

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <script defer src="./../vue/js/home.js"></script>
    <title>Home</title>
</head>
<body>

        <!-- Header Admin -->
    <header>
        <a href="">LOGO</a>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="./../vue/src/blog.php">Blog</a></li>
            <li><a href="./../vue/src/profil.php">Profil</a></li>
            <li><a href="./../vue/src/create.php">Create</a></li>
            <li><a href="./../vue/src/admin.php">Admin</a></li>
            <li><a href="./../app/controller/deconnect.php">Deconected</a></li>

        </ul>
    </header>

    <?php
    elseif($role === 'moderator'):
    ?>
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <script defer src="./../vue/js/home.js"></script>

    <title>Home</title>
</head>
<body>

        <!-- Header Moderator -->

    <header>
        <a href="">LOGO</a>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="./../vue/src/blog.php">Blog</a></li>
            <li><a href="./../vue/src/create.php">Create</a></li>
            <li><a href="./../vue/src/profil.php">Profil</a></li>
            <li><a href="./../app/controller/deconnect.php">Deconected</a></li>

        </ul>
    </header>

    <?php
    else:
    ?>
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <script defer src="./../vue/js/home.js"></script>

    <title>Home</title>
</head>
<body>


        <!-- Header User -->

    <header>
        <a href="">LOGO</a>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="./../vue/src/blog.php">Blog</a></li>
            <li><a href="./../vue/src/profil.php">Profil</a></li>
            <li><a href="./../app/controller/deconnect.php">Deconected</a></li>

        </ul>
    </header>
    <?php
    endif;
    ?>

    <?php
    else:
    ?>
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <script defer src="./../vue/js/home.js"></script>
    <title>Home</title>
</head>
<body>

        <!-- Header invited -->

    <header>
        <a href="">LOGO</a>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="./../vue/src/blog.php">Blog</a></li>
            <li><a href="./../vue/src/connect.php">Connected</a></li>
            <li><a href="./../vue/src/register.php">Register</a></li>

        </ul>
    </header>

    <?php
    endif;
    ?>
<main>

    <section class="headerSearch">
        <div>
            <h1>Blog Cuisine</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore eius corrupti quasi ex corporis ducimus dignissimos. Eveniet reprehenderit harum deleniti, nulla unde totam temporibus illum ea rem quis accusamus consequuntur dolorem cumque, corporis dolor deserunt natus fugiat, similique alias. Dolorum repellat voluptates temporibus recusandae nisi ipsa dolore esse quisquam ullam.</p>
        </div>
        <div>

            <!-- Le formulaire de recherche -->
            <form action="#?id=" id="formSearch">
                <label for="search">Article: </label>
                <input type="search" name="search" id="search" placeholder="Rechercher un Article ...">
                <button id="btn" disabled>Recherche</button>
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