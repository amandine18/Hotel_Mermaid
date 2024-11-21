<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/cookies.php');
require_once (__DIR__ . '/../../includes/header.php');
require_once (__DIR__ . '/../../includes/head.php');

if (isset($_SESSION['user_id'])){
    if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin'] != 1)
        header('Location: /src/user/profil.php');
}
else{
    header('Location: /src/user/login.php');
}
 
if ($_GET) {
    $stm = $pdo->prepare("SELECT * FROM bedroom WHERE id = ?");
    $stm->bindValue(1, $_GET['id']);
    $stm->execute();

    $row = $stm->fetch(PDO::FETCH_ASSOC);

    $stm = $pdo->prepare("SELECT * FROM reservation WHERE id = ?");
    $stm->bindValue(1, $_GET['id']);
    $stm->execute();
    
    $reservation = $stm->fetchAll(PDO::FETCH_ASSOC);
}

$template = new Template();

$stm = $pdo->query("SELECT b.*, c.name FROM bedroom as b, category as c WHERE c.id = b.category_id ORDER BY b.number");
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

$stm = $pdo->query("SELECT r.*, u.mail, b.number, b.price, c.name FROM reservation as r, user as u, bedroom as b, category as c WHERE r.user_id = u.id and r.bedroom_id = b.id and c.id = b.category_id ORDER BY r.arrival");
$reservations = $stm->fetchAll(PDO::FETCH_ASSOC);

?>
    <?php echo $template::getHead('Admin'); ?>
    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <h3>Chambres</h3>
                <div class="col-12 col-md-9 col-xl-12 col-sm-6 py-md-3 pl-md-5 bd-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Numéro</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Lit double</th>
                            <th scope="col">Lit double king size</th>
                            <th scope="col">Balcon</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $r) { ?>
                            <tr>
                                <th scope="row"><?=$r['id']?></th>
                                <td><?=$r['number']?></td>
                                <td><?=$r['name']?></td>
                                <td><?=$r['double_bed']?></td>
                                <td><?=$r['double_king_bed']?></td>
                                <td><?=($r['balcon']==0) ? 'non' : 'oui'?></td>
                                <td><?=$r['price']?></td>
                                <td>
                                    <a class="btn btn-warning" href="/src/bedroom/edit.php?id=<?=$r['id']?>">Modifier</a>
                                    <a class="btn btn-danger" href="/src/bedroom/delete.php?id=<?=$r['id']?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <p>
                        <a href="/src/bedroom/new.php" class="btn btn-primary">Nouvelle</a>
                    </p>
                </div>
                <h3>Réservations</h3>
                <div class="col-12 col-md-9 col-xl-12 py-md-3 pl-md-5 bd-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Chambre</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Client</th>
                            <th scope="col">Arrivée</th>
                            <th scope="col">Départ</th>
                            <th scope="col">Nb adultes</th>
                            <th scope="col">Nb enfants</th>
                            <th scope="col">Coût (€)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reservations as $res) { ?>
                        <tr>
                            <td><?=$res['number']?></td>
                            <td><?=$res['name']?></td>
                            <td><?=$res['mail']?></td>
                            <td><?=$res['arrival']?></td>
                            <td><?=$res['departure']?></td>
                            <td><?=$res['adultes']?></td>
                            <td><?=$res['enfants']?></td>
                            <td>
                                <?php $date1 = strtotime($res['departure']);
                                    $date2 = strtotime($res['arrival']);
                                    $nbjourstime = $date1 - $date2;
                                    $nbjours = $nbjourstime/86400;
                                    $cout = $nbjours * intval($res['price']);
                                    echo $cout;
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

</html>