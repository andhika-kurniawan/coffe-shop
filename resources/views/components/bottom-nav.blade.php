<!-- Bottom Navigation (Mobile Only) -->
<nav x-show="!$store.productDetail.open" class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-border z-40">
    <div class="flex justify-around items-center px-2 py-2 pb-3">
        <!-- Menu -->
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1.5 py-1">
            <span class="w-12 h-12 {{ request()->routeIs('home') ? 'bg-stabilo' : 'bg-transparent' }} rounded-2xl flex items-center justify-center transition">
                <svg class="w-6 h-6 {{ request()->routeIs('home') ? 'text-primary' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1M6 8h12v9a4 4 0 01-4 4h-4a4 4 0 01-4-4V8zM6 2v2M10 2v2M14 2v2"></path>
                </svg>
            </span>
            <span class="text-xs {{ request()->routeIs('home') ? 'font-bold text-primary' : 'font-medium text-gray-400' }}">Menu</span>
        </a>

        <!-- Orders -->
        <a href="{{ route('orders.index') }}" class="flex flex-col items-center gap-1.5 py-1">
            <span class="w-12 h-12 {{ request()->routeIs('orders.*') ? 'bg-stabilo' : 'bg-transparent' }} rounded-2xl flex items-center justify-center transition">
                <svg class="w-6 h-6 {{ request()->routeIs('orders.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </span>
            <span class="text-xs {{ request()->routeIs('orders.*') ? 'font-bold text-primary' : 'font-medium text-gray-400' }}">Orders</span>
        </a>

        <!-- Rewards -->
        <a href="#" class="flex flex-col items-center gap-1.5 py-1">
            <span class="w-12 h-12 bg-transparent rounded-2xl flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </span>
            <span class="text-xs font-medium text-gray-400">Rewards</span>
        </a>

        <!-- Profile -->
        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-1.5 py-1">
            <span class="w-12 h-12 {{ request()->routeIs('profile.*') ? 'bg-stabilo' : 'bg-transparent' }} rounded-2xl flex items-center justify-center overflow-hidden">
                @auth
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background={{ request()->routeIs('profile.*') ? 'C2FA0A' : 'E5E5EA' }}&color=0D0D0D&bold=true" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full object-cover">
                @else
                    <svg class="w-6 h-6 {{ request()->routeIs('profile.*') ? 'text-primary' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                @endauth
            </span>
            <span class="text-xs {{ request()->routeIs('profile.*') ? 'font-bold text-primary' : 'font-medium text-gray-400' }}">Profile</span>
        </a>
    </div>
</nav>
