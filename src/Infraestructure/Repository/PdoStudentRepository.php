<?php

namespace Alura\Pdo\Infraestructure\Repository;

use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Domain\Model\Student;
use DateTimeImmutable;
use PDO;

class PdoStudentRepository implements StudentRepository
{   
    private \PDO $connection;

    public function __construct(PDO $connection)
    {
        $this -> connection = $connection;
    }

    public function allStudents(): array
    {
        $query = "SELECT * FROM students;";
        $statement = $this -> connection -> query($query);

        return $this -> hydrateStudentList($statement);

    }

    public function studentsBirthAt(\DateTimeInterface $birthDate): array
    {
        $query = "SELECT FROM students WHERE birth_date = ?;";
        $statement = $this -> connection -> prepare($query);
        $statement -> bindValue(1, $birthDate->format('Y-m-d'));
        $statement -> execute();

        return $this -> hydrateStudentList($statement);
    }

    public function hydrateStudentList(\PDOStatement $statement): array
    {
        $studentDataList = $statement -> fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach($studentDataList as $studentData){
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentList;
    }

    public function saveStudent(Student $student): bool
    {
        if($student -> id() === null){
            return $this -> insert($student);
        }

        return $this -> update($student);
    }

    public function removeStudent(Student $student): bool
    {
        $statement = $this -> connection -> prepare("DELETE FROM students WHERE id = ?;");
        $statement -> bindValue(1, $student -> id(), PDO::PARAM_INT);

        return $statement -> execute();
    }

    public function insert(Student $student): bool
    {
        $query = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";
        $statement = $this -> connection -> prepare($query);

        $succes = $statement -> execute([
            ":name" => $student -> name(),
            ":birth_date" => $student -> birthDate() -> format('Y-m-d'),
        ]);

        $student -> defineId($this -> connection -> lastInsertId());

        return $succes;
    }

    public function update(Student $student): bool
    {
        $query = "UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;";
        $statement = $this -> connection -> prepare($query);
        $statement -> bindValue(':name', $student -> name());
        $statement -> bindValue(':birth_date', $student -> birthDate()->format('Y-m-d'));
        $statement -> bindValue(':id', $student->id(), PDO::PARAM_INT);

        return $statement -> execute();
    }
}