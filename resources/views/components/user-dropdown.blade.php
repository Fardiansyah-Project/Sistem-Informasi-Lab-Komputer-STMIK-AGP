<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <!-- User Avatar Button -->
    <button @click="open = !open"
        class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center shadow-md shadow-indigo-200 hover:shadow-lg hover:shadow-indigo-300 transition-shadow text-white font-bold text-sm">
        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl shadow-slate-300 py-1 z-50"
        style="display: none;">

        <!-- User Info -->
        <div class="px-4 py-3 border-b border-slate-200">
            <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->name ?? 'User' }}</p>
            <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>
