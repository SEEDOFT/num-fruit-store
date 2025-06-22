<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Fruit;

class FruitController extends Controller
{
    private $fruitModel;
    private $connection;

    /**
     * Establish Connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->fruitModel = new Fruit($this->connection);
    }

    /**
     * Show the main fruit store page for customers.
     */
    public function index()
    {
        $fruits = $this->fruitModel->getAll();
        require __DIR__ . '/../views/home/index.php';
    }

    /**
     * Show the admin dashboard with all fruits.
     */
    public function admin()
    {
        $fruits = $this->fruitModel->getAll();
        require __DIR__ . '/../views/admin/index.php';
    }

    /**
     * Show the form to create a new fruit.
     */
    public function create()
    {
        require __DIR__ . '/../views/admin/create.php';
    }

    /**
     * Store a new fruit in the database.
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->fruitModel->catId = $_POST['catId'];
            $this->fruitModel->name = $_POST['name'];
            $this->fruitModel->description = $_POST['description'];
            $this->fruitModel->qty = $_POST['qty'];
            $this->fruitModel->price = $_POST['price'];
            $this->fruitModel->image = $_POST['image'];
            $this->fruitModel->regDate = $_POST['regDate'];

            if ($this->fruitModel->create()) {
                header('Location: ' . BASE_PATH . '/admin');
                exit;
            }
        } else {
            header('Location: ' . BASE_PATH . '/admin/create');
            exit;
        }
    }

    /**
     * Show the form to edit an existing fruit.
     */
    public function edit($id)
    {
        $fruit = $this->fruitModel->getById($id);
        if ($fruit) {
            require __DIR__ . '/../views/admin/edit.php';
        } else {
            http_response_code(404);
            echo "Fruit not found.";
        }
    }

    /**
     * Update an existing fruit in the database.
     */
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL);

            if ($name && $description && $price !== false) {
                $this->fruitModel->update();
                header('Location: /num-fruit-store/admin');
                exit;
            } else {
                header('Location: /admin/edit/' . $id);
                exit;
            }
        }
    }

    /**
     * Delete a fruit from the database.
     */
    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->fruitModel->delete();
            header('Location: /admin');
            exit;
        } else {
            $fruit = $this->fruitModel->getById($id);
            if ($fruit) {
                echo "Are you sure you want to delete this fruit? <form method='post'><button type='submit'>Yes, Delete</button></form>";
            } else {
                http_response_code(404);
                echo "Fruit not found.";
            }
        }
    }
}
