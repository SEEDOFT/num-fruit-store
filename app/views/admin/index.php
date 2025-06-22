<?php require_once __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Fruits Inventory</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the fruits in your store including their name, price,
                and description.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="<?php echo BASE_PATH ?>/admin/create"
                class="inline-flex items-center justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:w-auto">
                Add Fruit
            </a>
        </div>
    </div>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Image
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Description</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Quantity</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <?php foreach ($fruits as $fruit): ?>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <img src="<?= htmlspecialchars(BASE_PATH . ($fruit['image'] ? '/storage/images/' . $fruit['image'] : '/storage/images/placeholder.png')) ?>"
                                            alt="<?= htmlspecialchars($fruit['name']) ?>"
                                            class="h-12 w-12 rounded-md object-cover">
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <?= htmlspecialchars($fruit['name']) ?>
                                    </td>
                                    <td class="whitespace-normal px-3 py-4 text-sm text-gray-500 max-w-xs truncate">
                                        <?= htmlspecialchars($fruit['description']) ?>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        $<?= htmlspecialchars(number_format($fruit['price'], 2)) ?>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <?= htmlspecialchars($fruit['qty']) ?>
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="<?php echo BASE_PATH ?>/admin/edit/<?= $fruit['frId'] ?>"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="<?php echo BASE_PATH ?>/admin/destroy/<?= $fruit['frId'] ?>"
                                            method="POST" class="inline pl-4"
                                            onsubmit="return confirm('Are you sure you want to delete this fruit?');">
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin_footer.php'; ?>