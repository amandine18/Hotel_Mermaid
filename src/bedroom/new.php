<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/cookies.php');
require_once (__DIR__ . '/../../includes/header.php');

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

    $sql = "INSERT INTO bedroom (number, file, category_id, price, description, double_bed, double_king_bed, balcon) VALUES (?,?,?,?,?,?,?,?)";
    $a = $pdo->prepare($sql)->execute([$_POST['numero'], $filename, $_POST['category'], $_POST['price'], $_POST['description'], $_POST['doublebed'], $_POST['doublekingbed'], $_POST['balcon']]);
    header("Location:../user/admin.php");
}

$stm = $pdo->query("SELECT id, name FROM category");

$categories = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <form method="post" enctype="multipart/form-data" action=""> <?php //cet enctype est obligatoire quand on a un type file ?>
                        <div class="form-group">
                            <label for="numero">Numéro</label>
                            <input type="text" class="form-control" name="numero" id="numero">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="doublebed">Lit 140cm</label>
                            <label>
                                <input type="radio" id="type3" name="doublebed" value="0" checked>
                                0
                            </label>
                            <label>
                                <input type="radio" id="type4" name="doublebed" value="1">
                                1
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="doublekingbed">Lit 160cm</label>
                            <label>
                                <input type="radio" id="type3" name="doublekingbed" value="0" checked>
                                0
                            </label>
                            <label>
                                <input type="radio" id="type4" name="doublekingbed" value="1">
                                1
                            </label>
                        </div>
                        <label>
                            <input type="radio" id="type1" name="balcon" value="0" checked>
                            Sans balcon
                        </label>
                        <label>
                            <input type="radio" id="type2" name="balcon" value="1">
                            Avec balcon
                        </label>
                        <div class="form-group">
                            <label for="price">Prix</label>
                            <input type="text" class="form-control" name="price" id="price">
                        </div>
                        <div class="form-group">
                            <label for="name">Category</label>
                            <select class="form-control" id="category" name="category">
                                <?php foreach ($categories as $c) { ?>
                                    <option value="<?=$c['id']?>"><?=$c['name']?></option>
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