<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infraestructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

$student = new Student(null, 'Márcia Belchior', new DateTimeImmutable('1998-08-15'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (?, ?);";
$statement = $pdo->prepare($sqlInsert);
$statement -> bindValue(1, $student -> name());
$statement -> bindValue(2, $student -> birthDate() -> format('Y-m-d'));

if($statement -> execute()){
    echo "Aluno incluido" . PHP_EOL;
}