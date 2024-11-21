<?php 

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/cookies.php');
require_once (__DIR__ . '/../../includes/header.php');
require_once (__DIR__ . '/../../includes/head.php');

$stm = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$stm->bindValue(1, $_SESSION['user_id']);
$stm->execute();

$row = $stm->fetch(PDO::FETCH_ASSOC);

$stm = $pdo->prepare("SELECT * FROM reservation WHERE id = ?");
$stm->bindValue(1, $_SESSION['user_id']);
$stm->execute();
    
$reservation = $stm->fetchAll(PDO::FETCH_ASSOC);

$template = new Template();

$stm = $pdo->query("SELECT r.*, u.id, b.*, c.name FROM reservation as r, user as u, bedroom as b, category as c WHERE r.user_id = u.id and r.bedroom_id = b.id and b.category_id = c.id ORDER BY r.arrival");
$reservations = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

    <?php echo $template::getHead('Profil'); ?>
    <div class="py-5 bg-light">
            <div class="container">
                <h3>Mes informations</h3>
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <table class="table">
                        <tr>
                            <th scope="col">Pseudo :</th>
                            <th><?=$row['pseudo']?></th>
                        </tr>
                        <tr>
                            <th scope="col">Email :</th>
                            <th><?=$row['mail']?></th>
                        </tr>
                    </table>
                </div>
                <h3>Mes réservations</h3>
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Chambre</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Arrivée</th>
                            <th scope="col">Départ</th>
                            <th scope="col">Nb adultes</th>
                            <th scope="col">Nb enfants</th>
                            <th scope="col">Coût (€)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reservations as $res) { 
                            if ($res['user_id'] == $_SESSION['user_id']) {?>
                                <tr>
                                    <td><?=$res['number']?></td>
                                    <td><?=$res['name']?></td>
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
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

</html>
