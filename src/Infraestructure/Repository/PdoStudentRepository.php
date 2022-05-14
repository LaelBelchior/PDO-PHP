<?php

namespace Alura\Pdo\Infraestructure\Repository;

use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Infraestructure\Persistence\ConnectionCreator;

class PdoStudentRepository implements StudentRepository
{   
    private \PDO $connection;

    public function __construct()
    {
        $this -> connection = ConnectionCreator::createConnection();
    }

    public function allStudents(): array
    {

    }

    public function studentsBirthAt(DateTimeInterface $birthDate): array
    {

    }

    public function saveStudent(Student $student): bool
    {

    }

    public function removeStudent(Student $student): bool
    {

    }
}