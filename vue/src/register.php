<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../../public/style/style.css">
    <link rel="stylesheet" href="./../../public/style/connect.css">
    <script defer src="./../js/register.js"></script>
    <title>Inscription | Blog Cuisine</title>
</head>
<body>
    <?php require_once("./../includes/header.php") ?>

    <main>

        <form action="./../../app/controller/register.php" method="post" id="formRegister">
            
            <h1>Inscription</h1>
            
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Entre Votre Email">
            <small></small>
            
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Entre Votre Username">
            <small></small>
            
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Entre Votre Password">
            <small></small>
            
            <label for="co-password">Confirmer Password</label>
            <input type="password" name="repass" placeholder="Confirmer Votre Password">
            <small></small>
            
            <button class="btn">S'inscrire</button>
        </form>
        
    </main>

    <?php require_once("./../includes/footer.php") ?>
</body>
</html>