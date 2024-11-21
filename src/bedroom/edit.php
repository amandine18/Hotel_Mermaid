<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/cookies.php');
require_once (__DIR__ . '/../../includes/header.php');
require_once (__DIR__ . '/../../includes/head.php');


if ($_POST) {
    $filename = '';

    if (!empty($_FILES['file'])) {

        $targetDirectory = "../../uploads/";
        $file = $_FILES['file']['name'];

        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];

        $tmpName = $_FILES['file']['tmp_name'];
        $path_filename_ext = $targetDirectory . $filename . '.' . $ext;
        if (move_uploaded_file($tmpName, $path_filename_ext)) {
            $filename = $filename . '.' . $ext;
        }
    }
    
    $data = [
        'numero' => $_POST['numero'],
        'file' => $filename,
        'price' => $_POST['price'],
        'category' => $_POST['category'],
        'description' => $_POST['description'],
        'balcon' => $_POST['balcon'],
        'doublebed' => $_POST['doublebed'],
        'doublekingbed' => $_POST['doublekingbed'],
        'id' => $_GET['id'],
    ];
    $sql = "UPDATE bedroom SET number=:numero, file=:file, price=:price, category_id=:category, description=:description, balcon=:balcon, double_bed=:doublebed, double_king_bed=:doublekingbed WHERE id=:id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute($data);
    header("Location:../user/admin.php");
}

$stm = $pdo->query("SELECT id, name FROM category");

$categories = $stm->fetchAll(PDO::FETCH_ASSOC);

if ($_GET) {
    $stm = $pdo->query("SELECT * FROM bedroom WHERE id =" . $_GET['id']);

    $product = $stm->fetch(PDO::FETCH_ASSOC);
}

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="numero">Numéro</label>
                            <input type="text" class="form-control" name="numero" value="<?=$product['number']?>" id="numero">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" value="<?=$product['description']?>" id="description"></input>
                        </div>
                        <div class="form-group">
                            <label for="doublebed">Lit 140cm</label>
                            <input type="number" class="form-control" name="doublebed" value="<?=$product['double_bed']?>" id="doublebed" max=1 min=0></input>
                        </div>
                        <div class="form-group">
                            <label for="doublekingbed">Lit 160cm</label>
                            <input type="number" class="form-control" name="doublekingbed" value="<?=$product['double_king_bed']?>" id="doublekingbed" max=1 min=0></input>
                        </div>
                        <label>
                            <input type="radio" id="type1" name="balcon" value="0" id="balcon" checked>
                            Sans balcon
                        </label>
                        <label>
                            <input type="radio" id="type2" name="balcon" value="1" id="balcon">
                            Avec balcon
                        </label>
                        <div class="form-group">
                            <label for="price">Prix</label>
                            <input type="text" class="form-control" name="price" value="<?=$product['price']?>" id="price">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category">
                                <?php foreach ($categories as $c) { ?>
                                    <option <?=($product['category_id'] == $c['id']) ? "selected" : ''?> value="<?=$c['id']?>"><?=$c['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" class="form-control-file" name="file" id="file">
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