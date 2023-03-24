<?php
session_start();

// get the page number and store it in a global session variable
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = ($page < 1) ? 1 : $page;
$_SESSION['page'] = $page;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../public/style/style.css">
    <link rel="stylesheet" href="../../public/style/blog.css">
    <script defer src="../js/blog.js"></script>
    <title>Le Blog | Blog Cuisine</title>
</head>
<body>

    <?php require_once('./../includes/header.php'); ?>

    <main>
        <div class="pages">
            <button><a href="blog.php?page=<?php echo $page +1 ?>" id="btnSuivant">Page suivante >></a></button>
            <button><a href="blog.php?page=<?php echo $page -1 ?>">Page précédente <<</a></button>
        </div>

         
        <div class="blog">
            
                <!-- Display Fetch JS -->

        </div>
    </main>
    <?php require_once('./../includes/footer.php'); ?>
</body>
</html>