<?php

namespace Alura\Pdo\Domain\Model;

use DomainException;

class Student
{
    private ?int $id;
    private string $name;
    private \DateTimeInterface $birthDate;

    public function __construct(?int $id, string $name, \DateTimeInterface $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public function defineId(int $id): void
    {
        if(!is_null($this -> id)){
            throw new DomainException("Você só pode definir o ID uma única vez!");
        }

        $this -> id = $id;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function changeName(string $name): void
    {
        $this -> name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function birthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }
}
