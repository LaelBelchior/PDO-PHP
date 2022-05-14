<?php

require_once 'vendor/autoload.php';

$pdo = \Alura\Pdo\Infraestructure\Persistence\ConnectionCreator::createConnection();

$sqlDelete = "DELETE FROM students WHERE id = ?;";

$preparedStatement = $pdo -> prepare($sqlDelete);
$preparedStatement -> bindValue(1, 9);
$preparedStatement -> execute();