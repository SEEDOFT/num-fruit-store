<?php

namespace App\Models;

use PDO;

class Fruit
{
    private $connection;
    private int $frId;
    private int $catId;
    private string $name;
    private string $description;
    private int $qty;
    private float $price;
    private string $image;
    private string $regDate;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function getAll($catId = null)
    {
        $query = "SELECT f.*, c.category 
                  FROM fruits f
                  LEFT JOIN categories c ON f.catId = c.catId";

        if ($catId) {
            $query .= " WHERE f.catId = :catId";
        }

        $query .= " ORDER BY f.regDate DESC";
        $stmt = $this->connection->prepare($query);

        if ($catId) {
            $stmt->bindParam(':catId', $catId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM fruits WHERE frId = :frId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":frId", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $query = "INSERT INTO fruits (catId, name, description, price, qty, image) 
                  VALUES (:catId, :name, :description, :price, :qty, :image)";
        $stmt = $this->connection->prepare($query);

        $this->catId = intval(htmlspecialchars(strip_tags($this->catId)));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = floatval(htmlspecialchars(strip_tags($this->price)));
        $this->qty = intval(htmlspecialchars(strip_tags($this->qty)));
        $this->image = htmlspecialchars(strip_tags($this->image));

        $stmt->bindParam(":catId", $this->catId);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":qty", $this->qty);
        $stmt->bindParam(":image", $this->image);

        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE fruits 
                  SET catId = :catId, 
                      name = :name, 
                      description = :description, 
                      price = :price, 
                      qty = :qty, 
                      image = :image 
                  WHERE frId = :frId";
        $stmt = $this->connection->prepare($query);

        $this->frId = intval(htmlspecialchars(strip_tags($this->frId)));
        $this->catId = intval(htmlspecialchars(strip_tags($this->catId)));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = floatval(htmlspecialchars(strip_tags($this->price)));
        $this->qty = intval(htmlspecialchars(strip_tags($this->qty)));
        $this->image = htmlspecialchars(strip_tags($this->image));

        $stmt->bindParam(":frId", $this->frId);
        $stmt->bindParam(":catId", $this->catId);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":qty", $this->qty);
        $stmt->bindParam(":image", $this->image);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM fruits WHERE frId = :frId";
        $stmt = $this->connection->prepare($query);
        $this->frId = intval(htmlspecialchars(strip_tags($this->frId)));
        $stmt->bindParam(":frId", $this->frId);
        return $stmt->execute();
    }
}