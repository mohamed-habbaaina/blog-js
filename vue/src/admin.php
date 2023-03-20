<?php
session_start();

require_once('./../../app/class/Admin.php');

$admin = new Admin();

$mess = [];

// if(isset($_GET['username'])){
    
//     $username = $_GET['username'];
//     $admin->deleteUser($username);

//     $mess[] = "Vous avez supprimé l'utilisateur $username !";

// }

if(isset($_GET['idArticle'])){
    
    $idArticle = $_GET['idArticle'];
    $title = $_GET['title'];
    $admin->deleteArticle($idArticle);

    $mess[] = "Vous avez supprimé l'article $title !";

}

// var_dump($_POST);

if(isset($_POST['namecategorie']) && isset($_POST['description'])):
    
    $name = $admin->isValid($_POST['namecategorie']);
    $description = $admin->validText($_POST['description']);

    $admin->insertCaregory($name, $description);

    $mess[] = "La catégorie $name a été bien enregistrée !";


endif;
    


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
        </div>
        
        <div style="background-color:aqua">

        <?php

            // display message PHP.
                if(isset($mess)):

                    foreach ($mess as $value) {

                        echo $value;
                    }

                endif;                    
            ?>
        </div>

        <div class="container">

            <div class="adminCategory">

            <h2>Ajouter une catégorie</h2>

                <form action="#" method="post" id="formCategory">
                    <label for="name">Nom de la catégorie</label>
                    <input type="text" name="namecategorie">
                    <small></small>
                    <label for="description"></label>
                    <textarea name="description"></textarea>
                    <small></small>
                    <button>Valider</button>
                </form>
                
            </div>
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




