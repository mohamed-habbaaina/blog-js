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



</body>
</html>