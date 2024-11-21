<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/cookies.php');

if ($_GET) {
    $rows = $pdo->exec("DELETE r.*, b.* FROM reservation as r, bedroom as b WHERE r.bedroom_id = b.id and b.id =" . $_GET['id']);
    $row = $pdo->exec("DELETE b.* FROM bedroom as b WHERE b.id =" . $_GET['id']);
    if ($rows > 0) {
        header("Location: ../user/admin.php");
    } else {
        echo 'Error';
    }
    if ($row > 0) {
        header("Location: ../user/admin.php");
    } else {
        echo 'Error';
    }
}

?>