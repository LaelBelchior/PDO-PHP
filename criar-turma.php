<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infraestructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infraestructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

$connection -> beginTransaction();

$aStudent = new Student(
    null,
    'Gabrielle Ribeiro',
    new DateTimeImmutable('1998-05-15')
);

$studentRepository -> saveStudent($aStudent);

$otherStudent = new Student(
    null,
    'Yuri Guerreiro',
    new DateTimeImmutable('1998-11-02')
);

$studentRepository -> saveStudent($otherStudent);

$connection -> commit();