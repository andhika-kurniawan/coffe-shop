<!-- Product Customization Full Screen (Mobile) -->
<div x-show="$store.productDetail.open" class="fixed inset-0 bg-white z-[60] flex flex-col md:hidden" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">
    <div x-show="$store.productDetail.menu" class="flex flex-col h-full">
        <!-- Header -->
        <div class="shrink-0 bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
            <button @click="$store.productDetail.close()" class="flex items-center gap-2 text-xs font-black uppercase tracking-wide">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Brew
            </button>
            <button @click="window.location.href='/cart'" class="relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span x-show="$store.cart.items.length > 0" x-text="$store.cart.items.length" class="absolute -top-1 -right-1 w-5 h-5 bg-stabilo text-primary text-xs font-bold flex items-center justify-center rounded-full"></span>
            </button>
        </div>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-4 space-y-4">
                <!-- Product Image -->
                <div class="relative">
                    <div class="relative aspect-square rounded-2xl overflow-hidden bg-neutral">
                        <img x-show="$store.productDetail.menu.image" :src="`/storage/${$store.productDetail.menu.image}`" alt="" class="w-full h-full object-contain p-6">
                        <div class="absolute top-3 left-3">
                            <span class="inline-block px-3 py-1 bg-primary text-white text-xs font-black rounded-lg uppercase">Fresh Roast</span>
                        </div>
                        <div class="absolute bottom-3 right-3">
                            <span class="inline-block px-3 py-1.5 bg-white/90 backdrop-blur-sm text-primary text-xs font-semibold rounded-full">140 kcal · 12oz</span>
                        </div>
                    </div>
                </div>

                <!-- Title, Price & Description -->
                <div>
                    <div class="flex items-start justify-between mb-2">
                        <h1 x-text="$store.productDetail.menu.name" class="text-xl font-black uppercase leading-tight flex-1"></h1>
                        <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.productDetail.menu.price)}`" class="text-xl font-black ml-3"></span>
                    </div>
                    <p x-text="$store.productDetail.menu.description" class="text-sm text-gray-600 mb-3"></p>
                    <div class="flex gap-2">
                        <span class="inline-block px-3 py-1 bg-neutral text-xs font-bold rounded-full uppercase">Double Shot (150mg)</span>
                        <span class="inline-block px-3 py-1 bg-neutral text-xs font-bold rounded-full uppercase">Ethiopia Blend</span>
                    </div>
                </div>

                <!-- Temperature -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-black uppercase">Temperature</h3>
                        <span class="text-xs text-gray-500">Select preference</span>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <button @click="$store.productDetail.selectedOptions.temperature = 'hot'" :class="$store.productDetail.selectedOptions.temperature === 'hot' ? 'bg-primary text-stabilo' : 'bg-white border border-gray-200'" class="px-4 py-3 rounded-xl font-bold text-sm transition flex items-center justify-center gap-2">
                            🔥 Hot
                        </button>
                        <button @click="$store.productDetail.selectedOptions.temperature = 'iced'" :class="$store.productDetail.selectedOptions.temperature === 'iced' ? 'bg-primary text-stabilo' : 'bg-white border border-gray-200'" class="px-4 py-3 rounded-xl font-bold text-sm transition flex items-center justify-center gap-2">
                            ❄️ Iced
                        </button>
                    </div>
                </div>

                <!-- Sugar Level -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-black uppercase">Sugar Level</h3>
                        <span class="text-xs text-gray-500" x-text="$store.productDetail.selectedOptions.sugar === '50' ? 'Standard (50%)' : `${$store.productDetail.selectedOptions.sugar}%`"></span>
                    </div>
                    <div class="flex gap-2" x-show="$store.productDetail.sugarOptions.length > 0">
                        <template x-for="option in $store.productDetail.sugarOptions" :key="option.id">
                            <button @click="$store.productDetail.selectedOptions.sugar = option.value" :class="$store.productDetail.selectedOptions.sugar === option.value ? 'bg-primary text-stabilo border-primary' : 'bg-white border-gray-200'" class="flex-1 px-3 py-2 border-2 rounded-full font-bold text-sm transition" x-text="option.name"></button>
                        </template>
                    </div>
                    <div x-show="$store.productDetail.sugarOptions.length === 0" class="text-sm text-gray-400 text-center py-3 border-2 border-dashed border-gray-200 rounded-xl">No sugar options for this menu</div>
                </div>

                <!-- Ice Level -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-black uppercase">Ice Level</h3>
                        <span class="text-xs text-gray-500" x-text="$store.productDetail.selectedOptions.ice === 'normal' ? 'Standard' : $store.productDetail.selectedOptions.ice"></span>
                    </div>
                    <div class="flex gap-2" x-show="$store.productDetail.iceOptions.length > 0">
                        <template x-for="option in $store.productDetail.iceOptions" :key="option.id">
                            <button @click="$store.productDetail.selectedOptions.ice = option.value" :class="$store.productDetail.selectedOptions.ice === option.value ? 'bg-primary text-stabilo border-primary' : 'bg-white border-gray-200'" class="flex-1 px-3 py-2 border-2 rounded-full font-bold text-sm transition" x-text="option.name"></button>
                        </template>
                    </div>
                    <div x-show="$store.productDetail.iceOptions.length === 0" class="text-sm text-gray-400 text-center py-3 border-2 border-dashed border-gray-200 rounded-xl">No ice options for this menu</div>
                </div>

                <!-- Special Notes -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-black uppercase">Special Notes</h3>
                        <span class="text-xs text-gray-400">Optional</span>
                    </div>
                    <textarea x-model="$store.productDetail.notes" placeholder="e.g. Extra hot, less ice..." class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-stabilo focus:outline-none resize-none" rows="3"></textarea>
                </div>
            </div>
        </div>

        <!-- Footer Action Bar -->
        <div class="shrink-0 bg-white border-t border-gray-200 px-4 py-4">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 bg-neutral rounded-full px-2 py-1.5">
                    <button @click="$store.productDetail.quantity = Math.max(1, $store.productDetail.quantity - 1)" class="w-9 h-9 flex items-center justify-center font-bold text-lg rounded-full hover:bg-white transition">−</button>
                    <span x-text="String($store.productDetail.quantity).padStart(2, '0')" class="font-bold text-base w-7 text-center"></span>
                    <button @click="$store.productDetail.quantity += 1" class="w-9 h-9 flex items-center justify-center font-bold text-lg rounded-full hover:bg-white transition">+</button>
                </div>
                <button @click="$store.cart.addItem($store.productDetail.menu, {...$store.productDetail.selectedOptions, notes: $store.productDetail.notes}, $store.productDetail.quantity); $store.productDetail.close(); setTimeout(() => window.location.href = '/cart', 300)" class="flex-1 py-4 bg-stabilo text-primary rounded-full font-black uppercase text-sm transition hover:bg-opacity-90 flex items-center justify-center gap-2">
                    Order Now • <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.productDetail.totalPrice)}`"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Desktop Side Drawer -->
<div x-show="$store.productDetail.open" @click="$store.productDetail.close()" class="hidden md:block fixed inset-0 bg-black/40 z-[60]"></div>
<div x-show="$store.productDetail.open" class="hidden md:flex fixed right-0 top-0 bottom-0 w-96 bg-white z-[60] shadow-lg flex-col" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
    <div x-show="$store.productDetail.menu" class="flex flex-col h-full">
        <div class="p-6 flex-1 overflow-y-auto">
            <button @click="$store.productDetail.close()" class="mb-6 flex items-center gap-2 text-sm font-semibold hover:text-stabilo">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </button>
            <img x-show="$store.productDetail.menu.image" :src="`/storage/${$store.productDetail.menu.image}`" alt="" class="w-full h-40 rounded-xl object-contain bg-neutral p-4 mb-4">
            <h2 x-text="$store.productDetail.menu.name" class="text-xl font-black uppercase mb-1"></h2>
            <p x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.productDetail.menu.price)}`" class="text-lg font-bold mb-4"></p>
            <div class="space-y-4 mb-6">
                <div>
                    <h3 class="text-xs font-bold uppercase mb-2">Sugar</h3>
                    <div class="flex flex-wrap gap-1">
                        <template x-for="option in $store.productDetail.sugarOptions" :key="option.id">
                            <button @click="$store.productDetail.selectedOptions.sugar = option.value" :class="$store.productDetail.selectedOptions.sugar === option.value ? 'bg-stabilo text-primary border-stabilo' : 'bg-white border-border'" class="px-3 py-1 border-2 rounded-full text-xs font-semibold transition" x-text="option.name"></button>
                        </template>
                    </div>
                </div>
                <div>
                    <h3 class="text-xs font-bold uppercase mb-2">Ice</h3>
                    <div class="flex flex-wrap gap-1">
                        <template x-for="option in $store.productDetail.iceOptions" :key="option.id">
                            <button @click="$store.productDetail.selectedOptions.ice = option.value" :class="$store.productDetail.selectedOptions.ice === option.value ? 'bg-stabilo text-primary border-stabilo' : 'bg-white border-border'" class="px-3 py-1 border-2 rounded-full text-xs font-semibold transition" x-text="option.name"></button>
                        </template>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <h3 class="text-xs font-bold uppercase flex-1">Qty</h3>
                    <button @click="$store.productDetail.quantity = Math.max(1, $store.productDetail.quantity - 1)" class="w-8 h-8 border-2 border-border rounded text-sm hover:bg-neutral">−</button>
                    <span x-text="$store.productDetail.quantity" class="w-6 text-center text-sm font-bold"></span>
                    <button @click="$store.productDetail.quantity += 1" class="w-8 h-8 border-2 border-border rounded text-sm hover:bg-neutral">+</button>
                </div>
                <textarea x-model="$store.productDetail.notes" placeholder="Special notes..." class="w-full border-2 border-border rounded-lg px-3 py-2 text-sm focus:border-stabilo outline-none resize-none" rows="2"></textarea>
            </div>
        </div>
        <div class="shrink-0 p-4 border-t border-gray-200">
            <button @click="$store.cart.addItem($store.productDetail.menu, {...$store.productDetail.selectedOptions, notes: $store.productDetail.notes}, $store.productDetail.quantity); $store.productDetail.close(); setTimeout(() => window.location.href = '/cart', 300)" class="w-full py-3 bg-stabilo text-primary font-bold uppercase rounded-lg hover:bg-opacity-90 transition text-sm">
                Order Now • <span x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.productDetail.totalPrice)}`"></span>
            </button>
        </div>
    </div>
</div>
