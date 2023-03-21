<?php
session_start();
require_once('./../../app/class/Profil.php');
$profil = new Profil();

if(!$profil->isConnected()):
    header('location: ./../../public/index.php');
endif;

$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../../public/style/register.css">
    <script defer src="./../js/profil.js"></script>
    <title>Profil</title>
</head>
<body>
    <?php require_once("./../includes/header.php") ?>

    <main>

        <form action="./../../app/controller/profil.php" method="post" id="formProfil">
            
            <h1>Changer votre profil</h1>
            
            <label for="username">Username</label>
            <input type="text" name="username" value="<?= $username; ?>">
            <small></small>
            
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Entre Votre Password">
            <small></small>
            
            <label for="repass">Confirmer Password</label>
            <input type="password" name="repass" placeholder="Confirmer Votre Password">
            <small></small>
            
            <button>Envoyer</button>
        </form>
        
    </main>

    <?php require_once("./../includes/footer.php") ?>
</body>
</html>