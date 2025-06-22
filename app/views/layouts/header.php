<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="<?= BASE_PATH ?>" class="text-2xl font-bold text-green-600">Fruitastic</a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="<?= BASE_PATH ?>" class="text-gray-600 hover:bg-green-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        
                        <?php if (!isset($_SESSION['admin_id'])): ?>
                            <a href="<?= BASE_PATH ?>/admin" class="text-gray-600 hover:bg-green-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Admin</a>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="<?= BASE_PATH ?>/cart" class="text-gray-600 hover:bg-green-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Cart</a>
                            <a href="<?= BASE_PATH ?>/auth/logout" class="text-gray-600 hover:bg-green-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
                        <?php else: ?>
                            <a href="<?= BASE_PATH ?>/auth/login" class="text-gray-600 hover:bg-green-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            <a href="<?= BASE_PATH ?>/auth/register" class="text-gray-600 hover:bg-green-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">