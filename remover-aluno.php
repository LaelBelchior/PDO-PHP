<?php

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $databasePath);

$sqlDelete = "DELETE FROM students WHERE id = ?;";

$preparedStatement = $pdo -> prepare($sqlDelete);
$preparedStatement -> bindValue(1, 9);
$preparedStatement -> execute();