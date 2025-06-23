<?php

namespace App\Models;

use PDO;

class Category
{
    private $connection;
    private int $catId;
    private string $category;

    /**
     * Constructor for the Category model.
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
     * Fetches all categories from the database.
     */
    public function getAll(): array
    {
        $query = "SELECT * FROM categories ORDER BY category ASC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetches a single category by its ID.
     */
    public function getById(int $id)
    {
        $query = "SELECT * FROM categories WHERE catId = :catId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":catId", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  
    }

    /**
     * Creates a new category record in the database.
     */
    public function create(): bool
    {
        $query = "INSERT INTO categories (category) VALUES (:category)";
        $stmt = $this->connection->prepare($query);

        $this->category = htmlspecialchars(strip_tags($this->category));

        $stmt->bindParam(":category", $this->category);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Updates an existing category record.
     */
    public function update(): bool
    {
        $query = "UPDATE categories SET category = :category WHERE catId = :catId";
        $stmt = $this->connection->prepare($query);

        $this->catId = intval(htmlspecialchars(strip_tags($this->catId)));
        $this->category = htmlspecialchars(strip_tags($this->category));

        $stmt->bindParam(":catId", $this->catId);
        $stmt->bindParam(":category", $this->category);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Deletes a category record from the database.
     */
    public function delete(): bool
    {
        $query = "DELETE FROM categories WHERE catId = :catId";
        $stmt = $this->connection->prepare($query);

        $this->catId = intval(htmlspecialchars(strip_tags($this->catId)));

        $stmt->bindParam(":catId", $this->catId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
