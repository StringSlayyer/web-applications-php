<?php

declare(strict_types=1);

class Student {

    private int $id;
    private string $email;
    private string $firstname;
    private string $surname;
    private string $street;
    private string $city;
    private string $zip;
    private string $region;
    private string $gender;
    private string $note;

    public function __construct(
        int $id,
        string $email,
        string $firstname,
        string $surname,
        string $street,
        string $city,
        string $zip,
        string $region,
        string $gender,
        string $note = ''
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->street = $street;
        $this->city = $city;
        $this->zip = $zip;
        $this->region = $region;
        $this->gender = $gender;
        $this->note = $note;
    }

    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): void { $this->email = $email; }

    public function getFirstname(): string { return $this->firstname; }
    public function setFirstname(string $firstname): void { $this->firstname = $firstname; }

    public function getSurname(): string { return $this->surname; }
    public function setSurname(string $surname): void { $this->surname = $surname; }

    public function getStreet(): string { return $this->street; }
    public function setStreet(string $street): void { $this->street = $street; }

    public function getCity(): string { return $this->city; }
    public function setCity(string $city): void { $this->city = $city; }

    public function getZip(): string { return $this->zip; }
    public function setZip(string $zip): void { $this->zip = $zip; }

    public function getRegion(): string { return $this->region; }
    public function setRegion(string $region): void { $this->region = $region; }

    public function getGender(): string { return $this->gender; }
    public function setGender(string $gender): void { $this->gender = $gender; }

    public function getNote(): string { return $this->note; }
    public function setNote(string $note): void { $this->note = $note; }
}