<?php 
    require_once (__DIR__ . '/../config/database.php');
    require_once (__DIR__ . '/cookies.php');
    $stm = $pdo->query("SELECT isAdmin FROM user");
    $user = $stm->fetch(PDO::FETCH_ASSOC);
?>

        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Menu</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/src/bedroom/index.php">Nos chambres</a>
                        </li>
                        
                        <?php 
                        if (isset($_SESSION['user_id'])) { // On vérifie si l'utilisateur est connecté. Si oui on lui affiche :
                            echo '<li class="nav-item"><a class="nav-link" href="/src/user/profil.php">Profil</a></li>'; 
                                if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin'] == 1) { // On vérifie si l'utilisateur est admin. Si oui on lui affiche : 
                                    echo '<li class="nav-item"><a class="nav-link" href="../user/admin.php">Page admin</a></li>';
                                } 
                            echo '<li class="nav-item"><a class="nav-link" href="/src/user/logout.php">Déconnexion</a></li>';
                                        
                        } else { // Si l'utilisateur n'est pas connecté, il a un bouton "se connecter" : 
                            echo '<li class="nav-item"><a class="nav-link" href="/src/user/login.php">Se connecter</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/src/user/new.php">S\'inscrire</a></li>';
                        } 
                        ?>
                    </ul>
                </div>
            </nav>
        </header>