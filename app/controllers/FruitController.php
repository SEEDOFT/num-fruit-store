<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Fruit;
use App\Models\Category;

class FruitController extends Controller
{
    private $fruitModel;
    private $categoryModel;
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->fruitModel = new Fruit($this->connection);
        $this->categoryModel = new Category($this->connection);
    }

    private function checkAdminAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: ' . BASE_PATH . '/admin/login');
            exit;
        }
    }

    public function admin()
    {
        $this->checkAdminAuth();
        $fruits = $this->fruitModel->getAll();
        require __DIR__ . '/../views/admin/index.php';
    }

    public function index()
    {
        $categories = $this->categoryModel->getAll();
        $selectedCategory = $_GET['category'] ?? null;
        $fruits = $this->fruitModel->getAll($selectedCategory);

        require __DIR__ . '/../views/home/index.php';
    }

    public function create()
    {
        $this->checkAdminAuth();
        $categories = $this->categoryModel->getAll();
        require __DIR__ . '/../views/admin/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->fruitModel->catId = $_POST['catId'];
            $this->fruitModel->name = $_POST['name'];
            $this->fruitModel->description = $_POST['description'];
            $this->fruitModel->qty = $_POST['qty'];
            $this->fruitModel->price = $_POST['price'];

            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->handleImageUpload($_FILES['image']);
            }
            $this->fruitModel->image = $imagePath;

            if ($this->fruitModel->create()) {
                header('Location: ' . BASE_PATH . '/admin');
                exit;
            }
        }
        header('Location: ' . BASE_PATH . '/admin/create');
        exit;
    }

    public function edit($id)
    {
        $fruit = $this->fruitModel->getById($id);
        $categories = $this->categoryModel->getAll();
        if ($fruit) {
            require __DIR__ . '/../views/admin/edit.php';
        } else {
            http_response_code(404);
            echo "Fruit not found.";
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->fruitModel->frId = $id;
            $this->fruitModel->catId = $_POST['catId'];
            $this->fruitModel->name = $_POST['name'];
            $this->fruitModel->description = $_POST['description'];
            $this->fruitModel->price = $_POST['price'];
            $this->fruitModel->qty = $_POST['qty'];

            $imagePath = $_POST['current_image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $this->deleteImage($imagePath);
                $imagePath = $this->handleImageUpload($_FILES['image']);
            }
            $this->fruitModel->image = $imagePath;

            if ($this->fruitModel->update()) {
                header('Location: ' . BASE_PATH . '/admin');
                exit;
            }
        }
        header('Location: ' . BASE_PATH . '/admin/edit/' . $id);
        exit;
    }

    public function destroy($id)
    {
        $this->checkAdminAuth();
        $fruit = $this->fruitModel->getById($id);
        if ($fruit && $fruit['image']) {
            $this->deleteImage($fruit['image']);
        }

        $this->fruitModel->frId = $id;
        if ($this->fruitModel->delete()) {
            header('Location: ' . BASE_PATH . '/admin');
            exit;
        } else {
            http_response_code(500);
            echo "Failed to delete fruit.";
        }
    }

    private function handleImageUpload($file)
    {
        $uploadDir = 'storage/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileName = uniqid() . '-' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $fileName;
        }
        return null;
    }

    private function deleteImage($fileName)
    {
        if ($fileName) {
            $filePath = 'storage/images/' . $fileName;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}