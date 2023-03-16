<?php
session_start();

require_once('./../../app/class/Admin.php');

$admin = new Admin();


if(isset($_GET['username'])){
    
    $username = $_GET['username'];
    $admin->deleteUser($username);

}
if(isset($_GET['idArticle'])){
    
    $idArticle = $_GET['idArticle'];
    $admin->deleteArticle($idArticle);

}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../../public/style/style.css">
    <link rel="stylesheet" href="./../../public/style/admin.css">
    <script defer src="./../js/admin.js"></script>
    <title>Admin</title>
</head>
<body>

    <?php require_once('./../includes/header.php') ?>

    <main>

        <div class="btnAdmin">
            <button>Users</button>
            <button>Articles</button>
            <button>Catégorie d'articles</button>
        </div>
        
        <div>

            <div class="adminUsers">
                <!--  Display table users  -->
                
            </div>

            <div class="adminArticles">
                <!--  Display table articles  -->


            </div>
        </div>
    </main>

    <?php require_once('./../includes/header.php') ?>

</body>
</html>




