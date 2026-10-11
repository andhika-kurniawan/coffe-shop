<x-layouts.customer>
    <div class="container-narrow py-8">
        <h1 class="text-3xl font-black uppercase mb-8">Shopping Cart</h1>

        <div x-data class="space-y-6">
            <template x-if="$store.cart.items.length === 0">
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-neutral rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-neutral-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <p class="text-xl font-semibold mb-2">Your cart is empty</p>
                    <p class="text-neutral-text mb-6">Start adding some delicious coffee!</p>
                    <a href="{{ route('menu.index') }}" class="inline-block px-6 py-3 bg-stabilo text-primary font-semibold rounded-lg hover:bg-opacity-90 transition">
                        Browse Menu
                    </a>
                </div>
            </template>

            <template x-if="$store.cart.items.length > 0">
                <div>
                    <!-- Cart Items -->
                    <div class="space-y-4 mb-6">
                        <template x-for="item in $store.cart.items" :key="item.id">
                            <div class="card p-4 flex gap-4">
                                <img :src="`/storage/${item.image}`" alt="" class="w-24 h-24 rounded-lg object-cover">
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg mb-1" x-text="item.name"></h3>
                                    <p class="text-sm text-neutral-text mb-2" x-text="`Rp ${new Intl.NumberFormat('id-ID').format(item.price)}`"></p>
                                    <template x-if="Object.keys(item.options).length > 0">
                                        <p class="text-xs text-neutral-text mb-3" x-text="Object.entries(item.options).map(([k,v]) => `${k}: ${v}`).join(', ')"></p>
                                    </template>
                                    <div class="flex items-center gap-3">
                                        <button @click="$store.cart.updateQuantity(item.id, Math.max(1, item.quantity - 1))" class="w-8 h-8 border-2 border-border rounded hover:bg-neutral">−</button>
                                        <span x-text="item.quantity" class="font-semibold w-8 text-center"></span>
                                        <button @click="$store.cart.updateQuantity(item.id, item.quantity + 1)" class="w-8 h-8 border-2 border-border rounded hover:bg-neutral">+</button>
                                        <button @click="$store.cart.removeItem(item.id)" class="ml-auto text-error hover:bg-error/10 px-3 py-1 rounded">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Summary -->
                    <div class="card p-6">
                        <h2 class="font-bold text-lg mb-4">Order Summary</h2>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-neutral-text">Subtotal</span>
                                <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.cart.subtotal)}`" class="font-semibold"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-neutral-text">Delivery</span>
                                <span class="font-semibold text-stabilo">Free</span>
                            </div>
                        </div>
                        <div class="border-t border-border pt-4 mb-6">
                            <div class="flex justify-between text-xl">
                                <span class="font-bold">Total</span>
                                <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.cart.total)}`" class="font-bold"></span>
                            </div>
                        </div>
                        <a href="{{ auth()->check() ? route('checkout.index') : route('login') }}" class="block w-full py-4 bg-stabilo text-primary font-bold uppercase text-center rounded-lg hover:bg-opacity-90 transition">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </template>
        </div>
    </div>
</x-layouts.customer>