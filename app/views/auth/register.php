<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-lg shadow-lg">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create a new account
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="<?= BASE_PATH ?>/auth/register" method="POST">
            <div class="rounded-md shadow-sm space-y-4">
                <input name="firstName" type="text" required
                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="First Name">
                <input name="lastName" type="text" required
                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="Last Name">
                <input name="email" type="email" autocomplete="email" required
                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="Email address">
                <input name="phoneNumber" type="tel" required
                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="Phone Number">
                <input name="password" type="password" autocomplete="new-password" required
                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                    placeholder="Password">
            </div>
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Register
                </button>
            </div>
        </form>
        <p class="mt-2 text-center text-sm text-gray-600">
            Already have an account?
            <a href="<?= BASE_PATH ?>/auth/login" class="font-medium text-green-600 hover:text-green-500">
                Sign in
            </a>
        </p>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>