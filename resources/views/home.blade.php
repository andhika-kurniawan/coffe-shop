<x-layouts.customer>
    <!-- Search Bar -->
    <div class="bg-white py-4">
        <div class="container-wide">
            <div class="relative">
                <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" placeholder="Search your favorite coffee..." class="w-full pl-12 pr-4 py-3 bg-neutral rounded-xl text-sm border border-border focus:outline-none focus:ring-2 focus:ring-stabilo/30">
            </div>
        </div>
    </div>

    <!-- Hero Banner Promo -->
    <div class="bg-white pb-4">
        <div class="container-wide">
            <div class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 rounded-3xl overflow-hidden">
                <!-- Accent gradient -->
                <div class="absolute inset-0 bg-gradient-to-br from-stabilo/10 via-transparent to-transparent"></div>
                
                <div class="relative p-6">
                    <!-- Badges -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-stabilo text-primary text-xs font-black uppercase rounded-full">
                            ⚡ BUY 2 GET 1 FREE DEAL
                        </span>
                        <span class="text-white text-xs font-black tracking-wider">LIMITED DROP</span>
                    </div>

                    <!-- Content -->
                    <div>
                        <h2 class="text-3xl font-black uppercase leading-tight text-white mb-2">
                            {{ $promo->name }}<br>
                            <span class="text-stabilo">HOT & READY</span>
                        </h2>
                        <p class="text-sm text-white/70 mb-4 max-w-xs line-clamp-2">{{ $promo->description }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-white/50 text-sm line-through">Rp {{ number_format($promo->price * 1.2, 0, ',', '.') }}</span>
                                <span class="text-stabilo text-3xl font-black">Rp {{ number_format($promo->price, 0, ',', '.') }}</span>
                            </div>
                            <button @click="$store.productDetail.showProduct('{{ $promo->slug }}')" class="px-6 py-2.5 bg-stabilo text-primary font-black uppercase text-sm rounded-full hover:bg-opacity-90 transition flex items-center gap-2">
                                Claim Offer
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Chips -->
    <div class="bg-white py-4">
        <div class="container-wide">
            <div class="flex gap-2 overflow-x-auto pb-2">
                <button class="px-5 py-2 bg-primary text-stabilo font-bold text-sm rounded-full whitespace-nowrap">All</button>
                @foreach($categories as $cat)
                    <button class="px-5 py-2 bg-white text-gray-600 font-semibold text-sm rounded-full border border-gray-200 whitespace-nowrap hover:border-stabilo hover:text-primary transition">{{ $cat->name }}</button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Menu Grid "CURATED MENU" -->
    <div class="bg-white py-6">
        <div class="container-wide">
            <!-- Section Header -->
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-xl font-black uppercase">CURATED MENU</h3>
                <p class="text-xs text-gray-500">{{ count($menus) }} items available</p>
            </div>

            <!-- Grid 2 columns on mobile, 4 on desktop -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($menus as $menu)
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition group cursor-pointer relative" @click="$store.productDetail.showProduct('{{ $menu->slug }}')">
                    <!-- Image Container -->
                    <div class="relative aspect-square bg-neutral overflow-hidden">
                        <!-- Badge -->
                        @if($loop->first)
                            <div class="absolute top-2 left-2 z-10">
                                <span class="inline-block px-2.5 py-1 bg-primary text-stabilo text-xs font-black rounded-lg">Top Seller</span>
                            </div>
                        @elseif($loop->index === 1)
                            <div class="absolute top-2 left-2 z-10">
                                <span class="inline-block px-2.5 py-1 bg-stabilo text-primary text-xs font-black rounded-lg">Citrus Zest</span>
                            </div>
                        @elseif($loop->index === 2)
                            <div class="absolute top-2 left-2 z-10">
                                <span class="inline-block px-2.5 py-1 bg-white text-primary text-xs font-black rounded-lg border border-gray-200">Layered</span>
                            </div>
                        @elseif($loop->index === 3)
                            <div class="absolute top-2 left-2 z-10">
                                <span class="inline-block px-2.5 py-1 bg-primary text-white text-xs font-black rounded-lg">Plant-Based</span>
                            </div>
                        @endif

                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-contain p-4">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-6xl">☕</div>
                        @endif
                        
                        <!-- Add Button -->
                        <button @click.stop="$store.productDetail.showProduct('{{ $menu->slug }}')" class="absolute bottom-3 right-3 w-11 h-11 bg-stabilo text-primary rounded-full flex items-center justify-center font-black text-xl shadow-lg hover:scale-110 transition">
                            +
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="p-3">
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">{{ $menu->category->name }}</p>
                        <h4 class="font-bold text-base line-clamp-2 mb-2">{{ $menu->name }}</h4>
                        
                        <div class="flex items-center justify-between">
                            <span class="font-black text-lg">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            <span class="text-xs text-gray-500">12 oz</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Order in Progress Bar (Floating above bottom nav) -->
    <div x-show="$store.cart.items.length > 0" class="fixed bottom-20 left-0 right-0 px-4 z-30 md:bottom-4">
        <div class="container-wide max-w-2xl mx-auto">
            <div class="bg-primary rounded-2xl shadow-2xl px-5 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-stabilo text-primary rounded-full flex items-center justify-center font-black">
                        <span x-text="$store.cart.items.length"></span>
                    </div>
                    <div class="text-white">
                        <p class="text-xs opacity-80">Order in Progress</p>
                        <p class="font-bold" x-text="`Rp ${new Intl.NumberFormat('id-ID').format($store.cart.total)} total`"></p>
                    </div>
                </div>
                <button @click="cartOpen = true" class="px-5 py-2.5 bg-stabilo text-primary font-black text-sm rounded-full hover:bg-opacity-90 transition flex items-center gap-2">
                    View Cart
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</x-layouts.customer>