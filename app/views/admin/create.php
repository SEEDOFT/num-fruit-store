<?php require_once __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="bg-white shadow-md rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Add a New Fruit</h1>

    <form action="<?php echo BASE_PATH ?>/admin/store" method="POST" enctype="multipart/form-data">
        <div class="space-y-6">
            <div>
                <label for="catId" class="block text-sm font-medium text-gray-700">Fruit Category</label>
                <select id="catId" name="catId" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['catId']) ?>">
                            <?= htmlspecialchars($category['category']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Fruit Name</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" name="price" id="price" step="0.01" required
                        class="block w-full rounded-md border-gray-300 pl-7 focus:border-green-500 focus:ring-green-500 sm:text-sm">
                </div>
            </div>
             <div>
                <label for="qty" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="qty" id="qty" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"></textarea>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Fruit Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="<?php echo BASE_PATH ?>/admin"
                class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Cancel</a>
            <button type="submit"
                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Save
                Fruit</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/admin_footer.php'; ?>