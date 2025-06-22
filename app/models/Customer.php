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
    private string $phoneNumber;
    private ?string $address;
    private string $cityName;
    private ?int $postCode;
    private string $countryName;
    private ?string $regionState;

    /**
     * Constructor for the Customer model.
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Magic getter to access private properties.
     */
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    /**
     * Magic setter to update private properties.
     */
    public function __set(string $name, $value): void
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    /**
     * Fetches all customers from the database.
     */
    public function getAll(): array
    {
        $query = "SELECT * FROM customers ORDER BY lastName, firstName ASC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetches a single customer by their ID.
     */
    public function getById(int $id)
    {
        $query = "SELECT * FROM customers WHERE cusId = :cusId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":cusId", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new customer record in the database.
     */
    public function create(): bool
    {
        $query = "INSERT INTO customers (firstName, lastName, email, phoneNumber, address, cityName, postCode, countryName, regionState) 
                  VALUES (:firstName, :lastName, :email, :phoneNumber, :address, :cityName, :postCode, :countryName, :regionState)";
        $stmt = $this->connection->prepare($query);

        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));
        $this->address = htmlspecialchars(strip_tags($this->address ?? ''));
        $this->cityName = htmlspecialchars(strip_tags($this->cityName));
        $this->postCode = isset($this->postCode) ? intval(htmlspecialchars(strip_tags($this->postCode))) : null;
        $this->countryName = htmlspecialchars(strip_tags($this->countryName));
        $this->regionState = htmlspecialchars(strip_tags($this->regionState ?? ''));

        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
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

    /**
     * Updates an existing customer record.
     */
    public function update(): bool
    {
        $query = "UPDATE customers 
                  SET firstName = :firstName, 
                      lastName = :lastName, 
                      email = :email, 
                      phoneNumber = :phoneNumber, 
                      address = :address, 
                      cityName = :cityName, 
                      postCode = :postCode, 
                      countryName = :countryName, 
                      regionState = :regionState 
                  WHERE cusId = :cusId";
        $stmt = $this->connection->prepare($query);

        $this->cusId = intval(htmlspecialchars(strip_tags($this->cusId)));
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));
        $this->address = htmlspecialchars(strip_tags($this->address ?? ''));
        $this->cityName = htmlspecialchars(strip_tags($this->cityName));
        $this->postCode = isset($this->postCode) ? intval(htmlspecialchars(strip_tags($this->postCode))) : null;
        $this->countryName = htmlspecialchars(strip_tags($this->countryName));
        $this->regionState = htmlspecialchars(strip_tags($this->regionState ?? ''));

        $stmt->bindParam(":cusId", $this->cusId);
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
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

    /**
     * Deletes a customer record from the database.
     */
    public function delete(): bool
    {
        $query = "DELETE FROM customers WHERE cusId = :cusId";
        $stmt = $this->connection->prepare($query);

        $this->cusId = intval(htmlspecialchars(strip_tags($this->cusId)));

        $stmt->bindParam(":cusId", $this->cusId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
