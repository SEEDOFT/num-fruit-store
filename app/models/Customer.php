<?php

namespace App\Models;

use PDO;

class Customer
{
    private $connection;
    private int $cusId;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $phoneNumber;
    private ?string $address = 'n/a';
    private ?string $cityName = 'n/a';
    private ?int $postCode = 0;
    private ?string $countryName = 'n/a';
    private ?string $regionState = 'n/a';

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    public function __set(string $name, $value): void
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function findByEmail(string $email)
    {
        $query = "SELECT * FROM customers WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(): bool
    {
        $query = "INSERT INTO customers (firstName, lastName, email, password, phoneNumber, address, cityName, postCode, countryName, regionState) 
                  VALUES (:firstName, :lastName, :email, :password, :phoneNumber, :address, :cityName, :postCode, :countryName, :regionState)";
        $stmt = $this->connection->prepare($query);

        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));
        $this->address = htmlspecialchars(strip_tags($this->address ?? ''));
        $this->cityName = htmlspecialchars(strip_tags($this->cityName));
        $this->postCode = isset($this->postCode) ? intval(htmlspecialchars(strip_tags($this->postCode))) : null;
        $this->countryName = htmlspecialchars(strip_tags($this->countryName));
        $this->regionState = htmlspecialchars(strip_tags($this->regionState ?? ''));

        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phoneNumber", $this->phoneNumber);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":cityName", $this->cityName);
        $stmt->bindParam(":postCode", $this->postCode, $this->postCode === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindParam(":countryName", $this->countryName);
        $stmt->bindParam(":regionState", $this->regionState);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}