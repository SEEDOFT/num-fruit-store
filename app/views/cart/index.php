<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="bg-white">
    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Shopping Cart</h1>
        <?php if (empty($cartItems)): ?>
            <p class="mt-4 text-lg text-gray-500">Your cart is empty.</p>
        <?php else: ?>
            <div class="mt-12">
                <section>
                    <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                        <?php
                        $total = 0;
                        foreach ($cartItems as $item):
                            $total += $item['price'] * $item['quantity'];
                            ?>
                            <li class="flex py-6">
                                <div class="flex-shrink-0">
                                    <img src="<?= BASE_PATH . '/storage/images/' . htmlspecialchars($item['image'] ?: 'placeholder.png') ?>"
                                        alt="<?= htmlspecialchars($item['name']) ?>"
                                        class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32">
                                </div>

                                <div class="ml-4 flex-1 flex flex-col">
                                    <div>
                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                            <h3><?= htmlspecialchars($item['name']) ?></h3>
                                            <p class="ml-4">
                                                $<?= htmlspecialchars(number_format($item['price'] * $item['quantity'], 2)) ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex-1 flex items-end justify-between text-sm">
                                        <form action="<?= BASE_PATH ?>/cart/update" method="POST" class="flex items-center">
                                            <input type="hidden" name="frId" value="<?= $item['frId'] ?>">
                                            <label for="quantity-<?= $item['frId'] ?>" class="mr-2 text-gray-500">Qty</label>
                                            <input type="number" id="quantity-<?= $item['frId'] ?>" name="quantity"
                                                value="<?= $item['quantity'] ?>" min="1"
                                                class="w-16 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                            <button type="submit"
                                                class="ml-2 text-green-600 hover:text-green-800">Update</button>
                                        </form>

                                        <div class="flex">
                                            <form action="<?= BASE_PATH ?>/cart/remove" method="POST">
                                                <input type="hidden" name="frId" value="<?= $item['frId'] ?>">
                                                <button type="submit"
                                                    class="font-medium text-red-600 hover:text-red-500">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>

                <section class="mt-10">
                    <div class="bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8">
                        <h2 class="text-xl font-medium text-gray-900">Order summary</h2>
                        <dl class="mt-6 space-y-4">
                            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                <dt class="text-base font-medium text-gray-900">Order total</dt>
                                <dd class="text-base font-medium text-gray-900">$<?= number_format($total, 2) ?></dd>
                            </div>
                        </dl>
                        <div class="mt-6">
                            <button type="submit"
                                class="w-full bg-green-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-green-500">Checkout</button>
                        </div>
                    </div>
                </section>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>