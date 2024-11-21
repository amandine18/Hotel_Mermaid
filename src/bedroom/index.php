<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/cookies.php');
require_once (__DIR__ . '/../../includes/header.php');
require_once (__DIR__ . '/../../includes/head.php');
$template = new Template();

$rows = [];
if ($_GET) {
    $stm = $pdo->prepare("SELECT b.*, c.name FROM bedroom as b INNER JOIN category as c ON c.id = b.category_id WHERE b.category_id LIKE ? AND b.balcon = ? ORDER BY b.number");
    $stm->bindValue(1, $_GET['cat']);
    $stm->bindValue(2, $_GET['type']);
    $stm->execute();

    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
} 

else {
    $stm = $pdo->query("SELECT b.*, c.name FROM bedroom as b INNER JOIN category as c ON c.id = b.category_id ORDER BY b.number");
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
}

$stm = $pdo->query("SELECT id, name FROM category");
$categories = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

        <?php echo $template::getHead('Nos chambres'); ?>
        <div class="section">
            <img src="../../uploads/fond_chambre.png" alt="image de chambre">
            <h1 class="titre">Nos chambres</h1>
        </div>
        <div class="container">
            <div class="text1">
                <a>Confort et élégance</a>
                <p class="paragraphe">
                    Toutes nos chambres climatisées, dont certaines avec balcon, vous offrent tout le confort nécessaire à votre 
                    séjour. Vous-y trouverez la pièce principale avec un ventilateur de plafond et un coin bureau ainsi
                    qu'une salle de bain privative avec douche et WC. Elles sont équipées de Coffre Fort, Meuble Dressing,
                    TV écran plat, Canal +, Wifi, Sèche Cheveux. 
                </p>
            </div>
            <main role="main">

                <div class="py-5 bg-light">
                    <div class="container">
                        <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                            <form method="get" class="col-md-6" autocomplete="off">
                                <div class="md-form mt-0">
                                    <select class="form-control" id="cat" name="cat">
                                        <?php foreach ($categories as $c) { ?>
                                            <option value="<?=$c['id']?>"><?=$c['name']?></option>
                                        <?php } ?>
                                    </select>
                                    <label>
                                        <input type="radio" id="type1" name="type" value="0" checked>
                                        Sans balcon
                                    </label>
                                    <label>
                                        <input type="radio" id="type2" name="type" value="1">
                                        Avec balcon
                                    </label><br>
                                    <button type="submit">Rechercher</button>
                                </div>
                            </form><br>
                        </div>
                        <div class="row">
                            <?php foreach($rows as $row) { ?>
                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">
                                        <img class="img-fluid" src="/uploads/<?=$row['file'] ?>"/>
                                        <div class="card-body">
                                            <p class="card-text">
                                                <a class="a">Chambre <?=$row['number']?></a><br>
                                                <a class="a"><?=$row['description']?></a><br>
                                                <a class="a">Lit double 140cm : <?=$row['double_bed']?></a><br>
                                                <a class="a">Lit double 160cm : <?=$row['double_king_bed']?></a><br>
                                                <a class="a">Balcon : <?=$row['balcon']?></a><br>
                                                <a class="a">Prix : <?=$row['price']?>€/nuit</a><br>
                                                <a class="a">Catégorie : <?=$row['name']?></a>
                                                <?php if (isset($_SESSION['user_id'])) { ?>
                                                    <br><br>
                                                    <a href="/src/bedroom/reservation.php?id=<?=$row['id']?>" class="btn btn-primary">Réserver</a>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </main>
        </div>

<?php require_once (__DIR__ . '/../../includes/footer.php'); ?>