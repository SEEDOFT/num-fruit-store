<?php require_once __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="bg-white shadow-md rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Fruit: <?= htmlspecialchars($fruit['name']) ?></h1>

    <form action="<?php echo BASE_PATH ?>/admin/update/<?= $fruit['id'] ?>" method="POST">
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Fruit Name</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($fruit['name']) ?>" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" name="price" id="price" step="0.01"
                        value="<?= htmlspecialchars($fruit['price']) ?>" required
                        class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-green-500 focus:ring-green-500 sm:text-sm">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"><?= htmlspecialchars($fruit['description']) ?></textarea>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image URL (Optional)</label>
                <input type="text" name="image" id="image" value="<?= htmlspecialchars($fruit['image']) ?>"
                    placeholder="https://example.com/image.jpg"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                <img src="<?= htmlspecialchars($fruit['image'] ?: 'https://placehold.co/600x400/e2e8f0/cbd5e0?text=No+Image') ?>"
                    alt="Current Image" class="mt-2 h-24 w-auto rounded-md" />
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="<?php echo BASE_PATH ?>/admin"
                class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Cancel</a>
            <button type="submit"
                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Update
                Fruit</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/admin_footer.php'; ?>