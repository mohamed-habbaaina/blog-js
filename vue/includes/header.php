<?php
if(isset($_SESSION['role'])):
    
    $role = $_SESSION['role'];

    if($role === 'admin'):

?>

        <!-- Header Admin -->
    <header>
        <a href="">LOGO</a>
        <ul>
            <li><a href="../../public/index.php">Home</a></li>
            <li><a href="./blog.php">Blog</a></li>
            <li><a href="./profil.php">Profil</a></li>
            <li><a href="./create.php">Create</a></li>
            <li><a href="./admin.php">Admin</a></li>
            <li><a href="./../../app/controller/deconnect.php">Deconected</a></li>

        </ul>
    </header>

    <?php
    elseif($role === 'moderator'):
    ?>
        <!-- Header Moderator -->

    <header>
        <a href="">LOGO</a>
        <ul>
            <li><a href="../../public/index.php">Home</a></li>
            <li><a href="./blog.php">Blog</a></li>
            <li><a href="./create.php">Create</a></li>
            <li><a href="./profil.php">Profil</a></li>
            <li><a href="./../../app/controller/deconnect.php">Deconected</a></li>

        </ul>
    </header>

    <?php
    else:
    ?>

        <!-- Header User -->

    <header>
        <a href="">LOGO</a>
        <ul>
            <li><a href="../../public/index.php">Home</a></li>
            <li><a href="./blog.php">Blog</a></li>
            <li><a href="./profil.php">Profil</a></li>
            <li><a href="./../../app/controller/deconnect.php">Deconected</a></li>

        </ul>
    </header>
    <?php
    endif;
    ?>

    <?php
    else:
    ?>
        <!-- Header invited -->

    <header>
        <a href="">LOGO</a>
        <ul>
            <li><a href="../../public/index.php">Home</a></li>
            <li><a href="./blog.php">Blog</a></li>
            <li><a href="./connect.php">Connected</a></li>
            <li><a href="./register.php">Register</a></li>

        </ul>
    </header>

    <?php
    endif;
    ?>