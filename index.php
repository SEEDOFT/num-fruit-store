<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

use Config\Database;

$connection = Database::getInstance();

$request_uri = strtok($_SERVER['REQUEST_URI'], '?');
$base_path_len = strlen(BASE_PATH);

if (substr($request_uri, 0, $base_path_len) === BASE_PATH) {
    $route = substr($request_uri, $base_path_len);
} else {
    $route = $request_uri;
}

$route = trim($route, '/');
$parts = explode('/', $route);

$controllerName = "Fruit";
$action = "index";
$params = [];

if (!empty($parts[0])) {
    $controllerName = ucfirst($parts[0]);
}

if ($controllerName === 'Admin') {
    $action = $parts[1] ?? 'index';
    $admin_auth_actions = ['login', 'authenticate', 'logout'];

    if (in_array($action, $admin_auth_actions)) {
        $controllerName = 'Admin';
        $params = array_slice($parts, 2);
    } else {
        $controllerName = 'Fruit';
        $action = ($action === 'index') ? 'admin' : $action;
        $params = array_slice($parts, 2);
    }
} else {
    if (isset($parts[1])) {
        $action = $parts[1];
    }
    $params = array_slice($parts, 2);
}

$controllerClass = "App\\Controllers\\" . $controllerName . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass($connection);
    if (method_exists($controller, $action)) {
        call_user_func_array([$controller, $action], $params);
    } else {
        http_response_code(404);
        echo "404 Not Found - Action '{$action}' not found in controller '{$controllerName}'.";
    }
} else {
    http_response_code(404);
    echo "404 Not Found - Controller '{$controllerClass}' not found.";
}