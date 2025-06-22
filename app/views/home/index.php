<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="bg-white">
    <div class="px-4 pt-12 pb-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl text-center">
            <span class="block">Welcome to</span>
            <span class="block text-green-600">Fruitastic Online Store</span>
        </h1>
        <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl text-center">
            Discover the freshest and most delicious fruits, delivered right to you.
        </p>
    </div>

    <div class="px-4 py-6">
        <div class="flex flex-wrap justify-center items-center gap-4">
            <a href="<?= BASE_PATH ?>"
                class="px-4 py-2 text-sm font-medium rounded-md <?= !isset($_GET['category']) ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700' ?> hover:bg-green-500 hover:text-white transition-colors">
                All
            </a>
            <?php foreach ($categories as $category): ?>
                <a href="?category=<?= $category['catId'] ?>"
                    class="px-4 py-2 text-sm font-medium rounded-md <?= (isset($_GET['category']) && $_GET['category'] == $category['catId']) ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700' ?> hover:bg-green-500 hover:text-white transition-colors">
                    <?= htmlspecialchars($category['category']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="px-4 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php foreach ($fruits as $fruit): ?>
            <div
                class="group bg-white border border-gray-200 rounded-lg flex flex-col overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300">
                <div class="aspect-w-3 aspect-h-2 bg-gray-200 sm:aspect-none sm:h-48 relative">
                    <img src="<?= BASE_PATH . '/storage/images/' . htmlspecialchars($fruit['image'] ?: 'placeholder.png') ?>"
                        alt="<?= htmlspecialchars($fruit['name']) ?>"
                        class="w-full h-full object-center object-cover sm:w-full sm:h-full">
                    <?php if ($fruit['qty'] <= 0): ?>
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                            <span class="text-white text-lg font-bold">Out of Stock</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex-1 p-4 space-y-2 flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900">
                        <?= htmlspecialchars($fruit['name']) ?>
                    </h3>
                    <p class="text-sm text-gray-500 flex-1"><?= htmlspecialchars($fruit['description']) ?></p>

                    <div class="pt-2">
                        <?php if ($fruit['qty'] > 0 && $fruit['qty'] < 10): ?>
                            <p class="text-sm font-medium text-amber-600">Low stock (only <?= htmlspecialchars($fruit['qty']) ?>
                                left)</p>
                        <?php elseif ($fruit['qty'] > 0): ?>
                            <p class="text-sm text-gray-500">In stock: <?= htmlspecialchars($fruit['qty']) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <p class="text-xl font-semibold text-gray-900">
                            $<?= htmlspecialchars(number_format($fruit['price'], 2)) ?>
                        </p>

                        <?php if ($fruit['qty'] > 0): ?>
                            <form action="<?= BASE_PATH ?>/cart/add" method="POST">
                                <input type="hidden" name="frId" value="<?= $fruit['frId'] ?>">
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Add to Cart
                                </button>
                            </form>
                        <?php else: ?>
                            <span
                                class="inline-flex items-center px-3 py-1.5 border border-gray-200 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                                Add to Cart
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>