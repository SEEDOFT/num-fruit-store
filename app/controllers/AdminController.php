<?php

namespace App\Controllers;

use App\Models\Admin;

class AdminController extends Controller
{
    private $adminModel;
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->adminModel = new Admin($this->connection);
    }

    public function login()
    {
        require __DIR__ . '/../views/admin/login.php';
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = $this->adminModel->findByUsername($_POST['username']);

            if ($admin && $_POST['password'] === $admin['password']) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                header('Location: ' . BASE_PATH . '/admin');
                exit;
            } else {
                header('Location: ' . BASE_PATH . '/admin/login?error=1');
                exit;
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        session_destroy();
        header('Location: ' . BASE_PATH . '/admin/login');
        exit;
    }
}