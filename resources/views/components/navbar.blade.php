<nav class="sticky top-0 z-40 bg-white">
    <div class="container-wide flex items-center justify-between py-3">
        <!-- Left: Logo + Brand + Branch -->
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center">
                <span class="text-2xl">⚡</span>
            </div>
            <div>
                <div class="font-black uppercase text-base leading-none tracking-tight">ELECTRIC ROAST</div>
                <div class="text-xs text-neutral-600 mt-1 flex items-center gap-1">
                    Branch: SCBD Suite 1
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Right: Cart + Avatar -->
        <div class="flex items-center gap-3">
            <!-- Cart Badge -->
            <button @click="cartOpen = !cartOpen" class="relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span x-show="$store.cart.items.length > 0" x-text="$store.cart.items.length" class="absolute -top-1 -right-1 w-5 h-5 bg-stabilo text-primary text-xs font-bold flex items-center justify-center rounded-full"></span>
            </button>

            <!-- Avatar -->
            @auth
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=E5E5EA&color=0D0D0D&bold=true" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            @endauth
        </div>
    </div>
</nav>