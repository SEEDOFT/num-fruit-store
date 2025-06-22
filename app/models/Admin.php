<?php

namespace App\Models;

use PDO;

class Admin
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findByUsername(string $username)
    {
        $query = "SELECT * FROM admins WHERE username = :username";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}