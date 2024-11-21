<?php
session_start();


require_once (__DIR__ . '/global.php');

$dbName = DB_NAME;
$dbHost = DB_HOST;

$dsn = "mysql:host=$dbHost;port=3308;dbname=$dbName";

$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);