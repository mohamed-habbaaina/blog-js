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
    <link rel="stylesheet" href="./../../public/style/connect.css">
    <script defer src="./../js/connect.js"></script>
    <title>Connection</title>
</head>
<body>
    <?php require_once("./../includes/header.php") ?>

    <main>

        <form action="./../../app/controller/connect.php" method="post" id="formConnect">
            
            <h1>Connexion</h1>
            
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Entre Votre Email">
            <small></small>
            
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Entre Votre Password">
            <small></small>
            
            <button>S'inscrire</button>

        </form>
        
    </main>

    <?php require_once("./../includes/footer.php") ?>
</body>
</html>