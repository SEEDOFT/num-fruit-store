<?php

namespace App\Controllers;

use App\Models\CartItem;

class CartController extends Controller
{
    private $cartItemModel;
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->cartItemModel = new CartItem($this->connection);
        $this->checkAuth();
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_PATH . '/auth/login');
            exit;
        }
    }

    public function index()
    {
        $cartItems = $this->cartItemModel->getCartForCustomer($_SESSION['user_id']);
        require __DIR__ . '/../views/cart/index.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->cartItemModel->cusId = $_SESSION['user_id'];
            $this->cartItemModel->frId = $_POST['frId'];
            $this->cartItemModel->quantity = $_POST['quantity'] ?? 1;

            if ($this->cartItemModel->addOrUpdate()) {
                header('Location: ' . BASE_PATH . '/cart');
            } else {
                echo "Failed to add to cart.";
            }
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->cartItemModel->updateQuantity($_SESSION['user_id'], $_POST['frId'], $_POST['quantity']);
            header('Location: ' . BASE_PATH . '/cart');
            exit;
        }
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->cartItemModel->remove($_SESSION['user_id'], $_POST['frId']);
            header('Location: ' . BASE_PATH . '/cart');
            exit;
        }
    }
}