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

                    <li><a href="./create.php">>Écrire un article</a></li> 

                <?php endif // for other logged users ?>

                <li><a href="./profil.php">Profil</a></li>

                <li><a href="./../../app/controller/deconnect.php">Déconnexion</a></li>

            <?php else: // for guests ?>

                <li><a href="connect.php">Connexion</a></li>
                
                <li><a href="register.php">Inscription</a></li>

            <?php endif ?>

        </ul>
    </nav>
</header>
