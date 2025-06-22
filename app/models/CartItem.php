<?php

namespace App\Models;

use PDO;

class CartItem
{
    private $connection;
    private int $cartItemId;
    private int $cusId;
    private int $frId;
    private int $quantity;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function getCartForCustomer($cusId)
    {
        $query = "SELECT f.frId, f.name, f.price, f.image, ci.quantity 
                  FROM cart_items ci
                  JOIN fruits f ON ci.frId = f.frId
                  WHERE ci.cusId = :cusId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":cusId", $cusId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($cusId, $frId)
    {
        $query = "SELECT * FROM cart_items WHERE cusId = :cusId AND frId = :frId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':cusId', $cusId);
        $stmt->bindParam(':frId', $frId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addOrUpdate()
    {
        $existing = $this->find($this->cusId, $this->frId);
        if ($existing) {
            $query = "UPDATE cart_items SET quantity = quantity + :quantity WHERE cusId = :cusId AND frId = :frId";
        } else {
            $query = "INSERT INTO cart_items (cusId, frId, quantity) VALUES (:cusId, :frId, :quantity)";
        }

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':cusId', $this->cusId);
        $stmt->bindParam(':frId', $this->frId);
        $stmt->bindParam(':quantity', $this->quantity);

        return $stmt->execute();
    }

    public function updateQuantity($cusId, $frId, $quantity)
    {
        $query = "UPDATE cart_items SET quantity = :quantity WHERE cusId = :cusId AND frId = :frId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':cusId', $cusId, PDO::PARAM_INT);
        $stmt->bindParam(':frId', $frId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function remove($cusId, $frId)
    {
        $query = "DELETE FROM cart_items WHERE cusId = :cusId AND frId = :frId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':cusId', $cusId);
        $stmt->bindParam(':frId', $frId);
        return $stmt->execute();
    }
}