<header>
    <a href="../../public/index.php">LOGO</a>
    <nav>
        <ul>
            <li><a href="../../public/index.php">Accueil</a></li>
            <li><a href="./blog.php">Blog</a></li>

            <?php if(isset($_SESSION['role'])): // for logged users ?>

                <?php if($_SESSION['role'] === 'admin'): // for admins ?>

                    <li><a href="./admin.php">Admin</a></li>

                <?php endif ?>

                <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'moderator'): // for admins & moderators ?>

                    <li><a href="./create.php">Create</a></li> 

                <?php endif // for guests ?>

                <li><a href="./profil.php">Profil</a></li>

                <li><a href="./../../app/controller/deconnect.php">Deconected</a></li>

            <?php else: ?>

                <li><a href="connect.php">Connected</a></li>
                
                <li><a href="register.php">Register</a></li>

            <?php endif ?>

        </ul>
    </nav>
</header>
