<x-layouts.customer>
    <div class="container-narrow py-8">
        <h1 class="text-3xl font-black uppercase mb-8">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST" x-data class="space-y-6">
            @csrf
            
            <!-- Order Items Preview -->
            <div class="card p-6">
                <h2 class="font-bold text-lg mb-4">Order Items</h2>
                <div class="space-y-3">
                    <template x-for="item in $store.cart.items" :key="item.id">
                        <div class="flex gap-3 pb-3 border-b border-border last:border-0">
                            <img :src="`/storage/${item.image}`" alt="" class="w-12 h-12 rounded-lg object-cover">
                            <div class="flex-1 text-sm">
                                <h3 class="font-semibold" x-text="item.name"></h3>
                                <template x-if="Object.keys(item.options).length > 0">
                                    <p class="text-xs text-neutral-text" x-text="Object.entries(item.options).map(([k,v]) => `${k}: ${v}`).join(', ')"></p>
                                </template>
                                <p class="text-xs text-neutral-text" x-text="`Qty: ${item.quantity} × Rp ${new Intl.NumberFormat('id-ID').format(item.price)}`"></p>
                            </div>
                            <span class="font-semibold text-sm" x-text="`Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.quantity)}`"></span>
                        </div>
                    </template>
                </div>
                
                <div class="mt-4 space-y-2 pt-4 border-t border-border">
                    <div class="flex justify-between text-sm">
                        <span>Subtotal</span>
                        <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.cart.subtotal)}`"></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Delivery</span>
                        <span class="text-stabilo">Free</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg pt-2 border-t border-border">
                        <span>Total</span>
                        <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.cart.total)}`"></span>
                    </div>
                </div>
            </div>

            <!-- Order Notes -->
            <div class="card p-6">
                <h2 class="font-bold text-lg mb-4">Special Notes</h2>
                <textarea name="notes" rows="3" placeholder="e.g., Extra napkins, no straw..." class="w-full border-2 border-border rounded-lg px-4 py-3 focus:border-stabilo outline-none"></textarea>
            </div>

            <!-- Hidden Fields -->
            <template x-for="(item, index) in $store.cart.items" :key="item.id">
                <div>
                    <input type="hidden" :name="`items[${index}][menu_id]`" :value="item.menu_id">
                    <input type="hidden" :name="`items[${index}][quantity]`" :value="item.quantity">
                    <input type="hidden" :name="`items[${index}][price]`" :value="item.price">
                    <template x-for="(value, key) in item.options" :key="key">
                        <input type="hidden" :name="`items[${index}][options][${key}]`" :value="value">
                    </template>
                </div>
            </template>
            <input type="hidden" name="subtotal" :value="$store.cart.subtotal">
            <input type="hidden" name="total" :value="$store.cart.total">

            <!-- Submit Button -->
            <button type="submit" class="w-full py-4 bg-stabilo text-primary font-bold uppercase rounded-lg hover:bg-opacity-90 transition">
                Place Order & Contact WhatsApp
            </button>
        </form>
    </div>
</x-layouts.customer>