<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="bg-white">
    <div class="px-4 py-12">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl text-center">
            <span class="block">Welcome to</span>
            <span class="block text-green-600">Fruitastic Online Store</span>
        </h1>
        <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl text-center">
            Discover the freshest and most delicious fruits, delivered right to you.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php foreach ($fruits as $fruit): ?>
            <div
                class="group relative bg-white border border-gray-200 rounded-lg flex flex-col overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300">
                <div class="aspect-w-3 aspect-h-2 bg-gray-200 sm:aspect-none sm:h-48">
                    <img src="<?= htmlspecialchars($fruit['image'] ?: 'https://placehold.co/600x400/e2e8f0/cbd5e0?text=No+Image') ?>"
                        alt="<?= htmlspecialchars($fruit['name']) ?>"
                        class="w-full h-full object-center object-cover sm:w-full sm:h-full">
                </div>
                <div class="flex-1 p-4 space-y-2 flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        <?= htmlspecialchars($fruit['name']) ?>
                    </h3>
                    <p class="text-sm text-gray-500 flex-1"><?= htmlspecialchars($fruit['description']) ?></p>
                    <p class="text-xl font-semibold text-gray-900">
                        $<?= htmlspecialchars(number_format($fruit['price'], 2)) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>