<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-lg border-b border-gray-100/80 shadow-sm sticky top-0 z-50 transition-all duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                        <div class="flex items-center gap-1.5">
                            <img src="{{ asset('images/logo-kemendikdasmen.jpg') }}" alt="Logo Kemendikdasmen" class="h-8 w-auto rounded transition-transform duration-300 group-hover:scale-105">
                            <img src="{{ asset('images/logo-kotamobagu.png') }}" alt="Logo Kotamobagu" class="h-8 w-auto transition-transform duration-300 group-hover:scale-105">
                        </div>
                        <div class="hidden sm:block">
                            <span class="text-sm font-extrabold text-gray-800 tracking-tight">SPNF SKB</span>
                            <span class="block text-[10px] text-gray-400 -mt-0.5 font-medium">Kota Kotamobagu</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex">
                    @if(auth()->user()->isPamong())
                        <x-nav-link :href="route('pamong.dashboard')" :active="request()->routeIs('pamong.dashboard')" class="!text-sm !font-medium">
                            <svg class="w-4 h-4 me-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('pamong.attendance.index')" :active="request()->routeIs('pamong.attendance.*')" class="!text-sm !font-medium">
                            <svg class="w-4 h-4 me-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Kehadiran
                        </x-nav-link>
                        <x-nav-link :href="route('pamong.reports.index')" :active="request()->routeIs('pamong.reports.*')" class="!text-sm !font-medium">
                            <svg class="w-4 h-4 me-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Laporan
                        </x-nav-link>
                    @elseif(auth()->user()->isKepalaSKB())
                        <x-nav-link :href="route('kepala.dashboard')" :active="request()->routeIs('kepala.dashboard')" class="!text-sm !font-medium">
                            <svg class="w-4 h-4 me-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('kepala.laporan.index')" :active="request()->routeIs('kepala.laporan.*')" class="!text-sm !font-medium">
                            <svg class="w-4 h-4 me-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            Laporan ACC
                        </x-nav-link>
                        <x-nav-link :href="route('kepala.rekap.index')" :active="request()->routeIs('kepala.rekap.*')" class="!text-sm !font-medium">
                            <svg class="w-4 h-4 me-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            Rekap
                        </x-nav-link>
                    @elseif(auth()->user()->isTU())
                        <x-nav-link href="/admin" class="!text-sm !font-medium">
                            <svg class="w-4 h-4 me-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Panel Admin
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-4 sm:gap-3">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold tracking-wide
                    @if(auth()->user()->isPamong()) bg-blue-50 text-blue-700 ring-1 ring-blue-200/60
                    @elseif(auth()->user()->isTU()) bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60
                    @else bg-amber-50 text-amber-700 ring-1 ring-amber-200/60
                    @endif">
                    {{ auth()->user()->role_label }}
                </span>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-xl text-gray-600 bg-gray-50/80 hover:bg-gray-100 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                            @if(Auth::user()->profile_photo_url)
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="" class="h-7 w-7 rounded-full object-cover me-2 ring-2 ring-white shadow-sm">
                            @else
                                <div class="h-7 w-7 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center me-2 ring-2 ring-white shadow-sm">
                                    <span class="text-[10px] font-bold text-white">{{ Auth::user()->initials }}</span>
                                </div>
                            @endif
                            <div class="max-w-[120px] truncate">{{ Auth::user()->name }}</div>
                            <svg class="ms-1.5 fill-current h-3.5 w-3.5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none transition duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1 px-2">
            @if(auth()->user()->isPamong())
                <x-responsive-nav-link :href="route('pamong.dashboard')" :active="request()->routeIs('pamong.dashboard')">
                    Dashboard
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pamong.attendance.index')" :active="request()->routeIs('pamong.attendance.*')">
                    Kehadiran
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pamong.reports.index')" :active="request()->routeIs('pamong.reports.*')">
                    Laporan Kegiatan
                </x-responsive-nav-link>
            @elseif(auth()->user()->isKepalaSKB())
                <x-responsive-nav-link :href="route('kepala.dashboard')" :active="request()->routeIs('kepala.dashboard')">
                    Dashboard
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kepala.laporan.index')" :active="request()->routeIs('kepala.laporan.*')">
                    Laporan ACC
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kepala.rekap.index')" :active="request()->routeIs('kepala.rekap.*')">
                    Rekap Kinerja
                </x-responsive-nav-link>
            @elseif(auth()->user()->isTU())
                <x-responsive-nav-link href="/admin">
                    Panel Admin
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings -->
        <div class="pt-4 pb-2 border-t border-gray-200 px-2">
            <div class="px-3 flex items-center gap-3">
                @if(Auth::user()->profile_photo_url)
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="" class="h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm">
                @else
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0 ring-2 ring-white shadow-sm">
                        <span class="text-sm font-bold text-white">{{ Auth::user()->initials }}</span>
                    </div>
                @endif
                <div class="min-w-0">
                    <div class="font-semibold text-sm text-gray-800 truncate">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
