<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/cookies.php');
require_once (__DIR__ . '/../../includes/header.php');
require_once (__DIR__ . '/../../includes/head.php');

if ($_POST) {
    $sql = "INSERT INTO reservation (user_id, bedroom_id, arrival, departure, adultes, enfants) VALUES (?,?,?,?,?,?)";
    $pdo->prepare($sql)->execute([$_SESSION['user_id'], $_GET['id'], $_POST['arrival'], $_POST['departure'], $_POST['adultes'], $_POST['kids']]);
    header("Location:../bedroom/index.php");
    exit();
}

$stm = $pdo->query("SELECT r.*, b.category_id, c.name FROM reservation as r, bedroom as b, category as c WHERE r.bedroom_id = b.id and c.id=b.category_id");
$reservations = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="arrival">Arrivée</label>
                            <input type="date" class="form-control" name="arrival" id="arrival">
                        </div>
                        <div class="form-group">
                            <label for="departure">Départ</label>
                            <input type="date" class="form-control" name="departure" id="departure">
                        </div>
                        <div class="form-group">
                            <label for="adultes">Nombre d'adultes</label>
                            <input type="number" class="form-control" name="adultes" id="adultes" value=1 max=4 min=1>
                        </div>
                        <div class="form-group">
                            <label for="kids">Nombre d'enfants</label>
                            <input type="number" class="form-control" name="kids" id="kids" value=0 max=3 min=0>
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