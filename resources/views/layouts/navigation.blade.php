<nav x-data="{ open: false }" class="glass shadow-lg sticky top-4 z-50 mx-auto mt-4 rounded-2xl border border-white/30 backdrop-blur-lg w-[90vw] max-w-5xl">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo/Brand -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-extrabold text-gradient tracking-tight drop-shadow-lg" style="font-family: 'Manrope', sans-serif; letter-spacing: -1px;">BookFlow</a>
            </div>
            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('dashboard') }}" class="nav-link-fb hover-lift hover-glow{{ request()->routeIs('dashboard') ? ' active' : '' }}">Dashboard</a>
                <a href="{{ route('bookings.index') }}" class="nav-link-fb hover-lift hover-glow{{ request()->routeIs('bookings.index') ? ' active' : '' }}">My Bookings</a>
                <a href="{{ route('bookings.create') }}" class="nav-link-fb hover-lift hover-glow{{ request()->routeIs('bookings.create') ? ' active' : '' }}">New Booking</a>
            </div>
            <!-- User Dropdown -->
            <div class="relative ml-4">
                <button id="userMenuButton" class="flex items-center focus:outline-none group" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="w-9 h-9 rounded-full object-cover">
                    @else
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-[#1877f2] text-white font-semibold text-lg" style="font-family: 'Inter', sans-serif;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    @endif
                    <span class="ml-2 text-gray-700 text-sm font-medium hidden sm:inline" style="font-family: 'Inter', sans-serif;">{{ Auth::user()->name }}</span>
                    <svg class="ml-1 w-4 h-4 text-gray-400 group-hover:text-[#1877f2] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="userDropdown" class="hidden absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg py-1 z-50">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" style="font-family: 'Inter', sans-serif;">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[#1877f2] hover:bg-gray-100" style="font-family: 'Inter', sans-serif;">Logout</button>
                    </form>
                </div>
            </div>
            <!-- Mobile Hamburger -->
            <div class="md:hidden flex items-center ml-2">
                <button id="mobileMenuButton" class="p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#1877f2]">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="md:hidden hidden bg-white border-t border-gray-200">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="nav-link-fb block w-full{{ request()->routeIs('dashboard') ? ' active' : '' }}">Dashboard</a>
            <a href="{{ route('bookings.index') }}" class="nav-link-fb block w-full{{ request()->routeIs('bookings.index') ? ' active' : '' }}">My Bookings</a>
            <a href="{{ route('bookings.create') }}" class="nav-link-fb block w-full{{ request()->routeIs('bookings.create') ? ' active' : '' }}">New Booking</a>
            <div class="border-t border-gray-100 my-2"></div>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" style="font-family: 'Inter', sans-serif;">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[#1877f2] hover:bg-gray-100" style="font-family: 'Inter', sans-serif;">Logout</button>
            </form>
        </div>
    </div>
    <style>
        .nav-link-fb {
            position: relative;
            color: #444;
            text-decoration: none;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            padding-bottom: 2px;
            transition: color 0.2s;
        }
        .nav-link-fb:hover, .nav-link-fb.active {
            color: #1877f2;
        }
        .nav-link-fb.active::after, .nav-link-fb:hover::after {
            content: '';
            display: block;
            margin: 0 auto;
            width: 80%;
            border-bottom: 3px solid #1877f2;
            border-radius: 1px;
            margin-top: 2px;
        }
    </style>
    <script>
        // User dropdown
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuButton = document.getElementById('userMenuButton');
            const userDropdown = document.getElementById('userDropdown');
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');
            if (userMenuButton && userDropdown) {
                userMenuButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });
                document.addEventListener('click', function(e) {
                    if (!userDropdown.contains(e.target) && !userMenuButton.contains(e.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</nav>
