<x-layouts.customer>
    <div class="container-wide py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-black uppercase mb-2">Our Menu</h1>
            <p class="text-neutral-text">Browse and customize your coffee</p>
        </div>

        <!-- Search & Filter -->
        <div class="mb-8" x-data="{ 
            search: '{{ request('search') }}', 
            category: '{{ request('category') }}',
            submitSearch() {
                const params = new URLSearchParams();
                if (this.search) params.append('search', this.search);
                if (this.category) params.append('category', this.category);
                window.location.href = '{{ route('menu.index') }}?' + params.toString();
            }
        }">
            <!-- Search Bar -->
            <div class="relative mb-4">
                <input 
                    type="text" 
                    x-model="search" 
                    @keydown.enter="submitSearch"
                    placeholder="Search menu..." 
                    class="w-full px-4 py-3 pl-12 border-2 border-border rounded-xl focus:border-stabilo outline-none transition"
                >
                <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-neutral-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <!-- Category Filter -->
            <div class="flex gap-2 overflow-x-auto pb-2">
                <button 
                    @click="category = ''; submitSearch()" 
                    :class="category === '' ? 'bg-stabilo text-primary border-stabilo' : 'bg-white border-border hover:border-stabilo'" 
                    class="px-4 py-2 border-2 rounded-full font-semibold text-sm whitespace-nowrap transition"
                >
                    All
                </button>
                @foreach($categories as $cat)
                    <button 
                        @click="category = '{{ $cat->slug }}'; submitSearch()" 
                        :class="category === '{{ $cat->slug }}' ? 'bg-stabilo text-primary border-stabilo' : 'bg-white border-border hover:border-stabilo'" 
                        class="px-4 py-2 border-2 rounded-full font-semibold text-sm whitespace-nowrap transition"
                    >
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Menu Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($menus as $menu)
                <div class="card overflow-hidden group hover:border-stabilo transition cursor-pointer" @click="$store.productDetail.showProduct('{{ $menu->slug }}')">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-neutral flex items-center justify-center">
                            <span class="text-5xl">☕</span>
                        </div>
                    @endif
                    
                    <div class="p-4">
                        <span class="inline-block px-2 py-1 bg-neutral text-xs font-semibold uppercase rounded mb-2">
                            {{ $menu->category->name }}
                        </span>
                        <h3 class="font-bold text-lg mb-1">{{ $menu->name }}</h3>
                        <p class="text-sm text-neutral-text mb-3 line-clamp-2">{{ $menu->description }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            <button class="px-4 py-2 bg-stabilo text-primary font-semibold rounded-lg hover:bg-opacity-90 transition text-sm">
                                Order
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-neutral-text text-lg mb-4">No menu items found</p>
                    <a href="{{ route('menu.index') }}" class="text-stabilo font-semibold hover:underline">Clear filters</a>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.customer>