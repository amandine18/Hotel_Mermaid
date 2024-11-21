<?php

require_once (__DIR__ . '/../../config/database.php');

if ($_POST) {
    $stm = $pdo->query("SELECT id, pseudo, password, isAdmin FROM user WHERE pseudo='" . $_POST['pseudo'] . "'");
    $user = $stm->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['pseudo'], $user['pseudo']) and password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['isAdmin'] = $user['isAdmin'];
        header("Location:../bedroom/index.php");
        exit();
    } 
    else {
        echo 'Pseudo ou mot de passe incorrect, veuillez réssayer';
    }
}

require_once (__DIR__ . '/../../includes/cookies.php');
require_once (__DIR__ . '/../../includes/head.php');
require_once (__DIR__ . '/../../includes/header.php');
$template = new Template();

?>

    <?php echo $template::getHead('Connexion'); ?>
    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="pseudo">pseudo</label>
                            <input type="text" class="form-control" name="pseudo" id="pseudo">
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>

    </main>


<?php

require_once (__DIR__ . '/../../includes/footer.php');

?>