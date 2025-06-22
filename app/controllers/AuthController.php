<?php

namespace App\Controllers;

use App\Models\Customer;

class AuthController extends Controller
{
    private $customerModel;
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->customerModel = new Customer($this->connection);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer = $this->customerModel->findByEmail($_POST['email']);
            if ($customer && password_verify($_POST['password'], $customer['password'])) {
                $_SESSION['user_id'] = $customer['cusId'];
                $_SESSION['user_name'] = $customer['firstName'];
                header('Location: ' . BASE_PATH);
                exit;
            } else {
                header('Location: ' . BASE_PATH . '/auth/login?error=1');
                exit;
            }
        }
        require __DIR__ . '/../views/auth/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->customerModel->firstName = $_POST['firstName'];
            $this->customerModel->lastName = $_POST['lastName'];
            $this->customerModel->email = $_POST['email'];
            $this->customerModel->password = $_POST['password'];
            $this->customerModel->phoneNumber = $_POST['phoneNumber'];

            if ($this->customerModel->create()) {
                header('Location: ' . BASE_PATH . '/auth/login');
                exit;
            } else {
                header('Location: ' . BASE_PATH . '/auth/register?error=1');
                exit;
            }
        }
        require __DIR__ . '/../views/auth/register.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_PATH);
        exit;
    }
}