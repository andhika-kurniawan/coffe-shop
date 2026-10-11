<!-- Cart Drawer -->
<div x-show="cartOpen" @click="cartOpen = false" class="fixed inset-0 bg-black/40 z-40 md:hidden"></div>

<div x-show="cartOpen" class="fixed bottom-0 left-0 right-0 z-50 md:hidden" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">
    <div class="bg-white rounded-t-3xl max-h-[85vh] overflow-y-auto">
        <!-- Handle -->
        <div class="flex justify-center pt-3 pb-4">
            <div class="w-10 h-1 bg-border rounded-full"></div>
        </div>

        <!-- Header -->
        <div class="sticky top-0 bg-white border-b border-border px-6 py-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">My Cart</h2>
                <button @click="cartOpen = false" class="p-2 hover:bg-neutral rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Cart Items -->
        <div class="px-6 py-4 space-y-3">
            <template x-if="$store.cart.items.length === 0">
                <div class="text-center py-12">
                    <p class="text-neutral-text">Your cart is empty</p>
                    <a href="{{ route('menu.index') }}" class="mt-4 inline-block px-6 py-2 bg-stabilo text-primary font-semibold rounded-lg hover:bg-opacity-90">Browse Menu</a>
                </div>
            </template>

            <template x-for="item in $store.cart.items" :key="item.id">
                <div class="flex gap-3 pb-3 border-b border-border">
                    <img :src="`/storage/${item.image}`" alt="" class="w-16 h-16 rounded-lg object-cover">
                    <div class="flex-1">
                        <h3 class="font-bold text-sm" x-text="item.name"></h3>
                        <p class="text-xs text-neutral-text" x-text="`Rp ${new Intl.NumberFormat('id-ID').format(item.price)}`"></p>
                        <template x-if="Object.keys(item.options).length > 0">
                            <p class="text-xs text-neutral-text mt-1" x-text="Object.entries(item.options).map(([k,v]) => `${k}: ${v}`).join(', ')"></p>
                        </template>
                        <div class="flex items-center gap-2 mt-2">
                            <button @click="$store.cart.updateQuantity(item.id, Math.max(1, item.quantity - 1))" class="w-6 h-6 border border-border rounded hover:bg-neutral">−</button>
                            <span x-text="item.quantity" class="w-6 text-center text-sm font-semibold"></span>
                            <button @click="$store.cart.updateQuantity(item.id, item.quantity + 1)" class="w-6 h-6 border border-border rounded hover:bg-neutral">+</button>
                            <button @click="$store.cart.removeItem(item.id)" class="ml-auto text-error hover:bg-error/10 p-1 rounded">🗑️</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Summary -->
        <template x-if="$store.cart.items.length > 0">
            <div class="border-t border-border px-6 py-4 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-neutral-text">Subtotal</span>
                    <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.cart.subtotal)}`" class="font-semibold"></span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-neutral-text">Delivery</span>
                    <span class="font-semibold text-stabilo">Free</span>
                </div>
                <div class="border-t border-border pt-3 flex justify-between">
                    <span class="font-bold">Total</span>
                    <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.cart.total)}`" class="font-bold text-lg"></span>
                </div>

                <!-- CTA -->
                <a href="{{ auth()->check() ? route('checkout.index') : route('login') }}" @click="$dispatch('checkout'); cartOpen = false" class="block w-full mt-4 py-3 bg-stabilo text-primary font-bold uppercase text-center rounded-lg hover:bg-opacity-90 transition">
                    Continue to Checkout
                </a>
            </div>
        </template>
    </div>
</div>

<!-- Desktop Side Drawer -->
<div x-show="cartOpen" @click="cartOpen = false" class="hidden md:block fixed inset-0 bg-black/40 z-40"></div>

<div x-show="cartOpen" class="hidden md:block fixed right-0 top-0 bottom-0 w-96 bg-white z-50 shadow-lg" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
    <div class="h-full flex flex-col">
        <!-- Header -->
        <div class="border-b border-border px-6 py-4 flex items-center justify-between">
            <h2 class="text-xl font-bold">My Cart</h2>
            <button @click="cartOpen = false" class="p-2 hover:bg-neutral rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Items -->
        <div class="flex-1 overflow-y-auto px-6 py-4 space-y-3">
            <template x-if="$store.cart.items.length === 0">
                <div class="text-center py-12">
                    <p class="text-neutral-text">Your cart is empty</p>
                </div>
            </template>

            <template x-for="item in $store.cart.items" :key="item.id">
                <div class="flex gap-3 pb-3 border-b border-border">
                    <img :src="`/storage/${item.image}`" alt="" class="w-16 h-16 rounded-lg object-cover">
                    <div class="flex-1 text-sm">
                        <h3 class="font-bold" x-text="item.name"></h3>
                        <p class="text-xs text-neutral-text" x-text="`Rp ${new Intl.NumberFormat('id-ID').format(item.price)}`"></p>
                        <div class="flex items-center gap-2 mt-2">
                            <button @click="$store.cart.updateQuantity(item.id, Math.max(1, item.quantity - 1))" class="w-5 h-5 border border-border rounded text-xs hover:bg-neutral">−</button>
                            <span x-text="item.quantity" class="w-5 text-center text-xs font-semibold"></span>
                            <button @click="$store.cart.updateQuantity(item.id, item.quantity + 1)" class="w-5 h-5 border border-border rounded text-xs hover:bg-neutral">+</button>
                            <button @click="$store.cart.removeItem(item.id)" class="ml-auto text-error text-xs">🗑️</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Summary & CTA -->
        <template x-if="$store.cart.items.length > 0">
            <div class="border-t border-border px-6 py-4 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-neutral-text">Subtotal</span>
                    <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.cart.subtotal)}`" class="font-semibold"></span>
                </div>
                <div class="flex justify-between text-sm border-b border-border pb-3">
                    <span class="text-neutral-text">Delivery</span>
                    <span class="font-semibold text-stabilo">Free</span>
                </div>
                <div class="flex justify-between font-bold">
                    <span>Total</span>
                    <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.cart.total)}`"></span>
                </div>

                <a href="{{ auth()->check() ? route('checkout.index') : route('login') }}" @click="$dispatch('checkout'); cartOpen = false" class="block w-full py-3 bg-stabilo text-primary font-bold uppercase text-center rounded-lg hover:bg-opacity-90 transition">
                    Checkout
                </a>
            </div>
        </template>
    </div>
</div>