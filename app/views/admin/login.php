<?php require_once __DIR__ . '/../../../config/env.inc' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Fruit Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900">
                    Admin Panel Login
                </h2>
            </div>
            <?php if (isset($_GET['error'])): ?>
                <div class="p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    Invalid username or password.
                </div>
            <?php endif; ?>
            <form class="mt-8 space-y-6" action="<?= BASE_PATH ?>/admin/authenticate" method="POST">
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="username" class="sr-only">Username</label>
                        <input id="username" name="username" type="text" required
                            class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none rounded-t-md focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm"
                            placeholder="Username">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required
                            class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none rounded-b-md focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm"
                            placeholder="Password">
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="relative flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md group hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>