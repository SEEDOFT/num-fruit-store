<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\FruitController;
use Config\Database;

$connection = Database::getInstance();
$controller = new FruitController($connection);

$request_uri = strtok($_SERVER['REQUEST_URI'], '?');
$route = BASE_PATH;
if (substr($request_uri, 0, strlen(BASE_PATH)) === BASE_PATH) {
    $route = substr($request_uri, strlen(BASE_PATH));
}

if (empty($route)) {
    $route = BASE_PATH;
}

$path = trim($route, '/');
$path_parts = explode('/', $path);

$action = 'index';
$id = null;

if (!empty($path_parts[0])) {
    if ($path_parts[0] === 'admin') {
        $action = 'admin';
        if (isset($path_parts[1])) {
            switch ($path_parts[1]) {
                case 'login':
                    $action = 'login';
                    break;
                case 'authenticate':
                    $action = 'authenticate';
                    break;
                case 'logout':
                    $action = 'logout';
                    break;
                case 'create':
                    $action = 'create';
                    break;
                case 'store':
                    $action = 'store';
                    break;
                case 'edit':
                    $action = 'edit';
                    $id = $path_parts[2] ?? null;
                    break;
                case 'update':
                    $action = 'update';
                    $id = $path_parts[2] ?? null;
                    break;
                case 'delete':
                    $action = 'destroy';
                    $id = $path_parts[2] ?? null;
                    break;
            }
        }
    }
}


if (method_exists($controller, $action)) {
    if ($id) {
        $controller->$action($id);
    } else {
        $controller->$action();
    }
} else {
    http_response_code(404);
    echo "404 Not Found - The requested page could not be found.";
}
