<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../../public/style/style.css">
    <link rel="stylesheet" href="./../../public/style/connect.css">
    <script defer src="./../js/connect.js"></script>
    <title>Connexion | Blog Cuisine</title>
</head>
<body>
    <?php require_once("./../includes/header.php") ?>

    <main>

        <form action="./../../app/controller/connect.php" method="post" id="formConnect">
            
            <h1>Connexion</h1>
            
            <label for="username">Username</label>
            <input type="username" name="username" placeholder="Entre Votre Username">
            
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Entre Votre Password">
            
            <button class="btn">Connexion</button>

        </form>
        
    </main>

    <?php require_once("./../includes/footer.php") ?>
</body>
</html>