<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $databasePath);

$statement = $pdo->query('SELECT * FROM students;');
$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
$studentList = [];

foreach($studentDataList as $student){
    $studentList[] = new Student(
        $student['id'],
        $student['name'],
        new DateTimeImmutable($student['birth_date'])
    );
}

var_dump($studentList);