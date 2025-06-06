<header class="bg-white fixed top-0 left-0 w-full flex items-center shadow-md z-50">
    <div class="container mx-auto">
        <div class="flex items-center justify-between relative">
            <!-- Logo -->
            <div class="px-4">
                <a href="{{ url('/') }}" class="font-bold text-lg text-primary block py-4">UMKMGrow</a>
            </div>

            <!-- Menu Navigasi -->
            <div class="flex items-center px-4">
                <!-- Hamburger Button -->
                <button id="hamburger" name="hamburger" type="button" class="block lg:hidden focus:outline-none">
                    <svg class="w-6 h-6 text-dark" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <!-- Navigation Menu -->
                <nav id="nav-menu" class="hidden absolute font-semibold py-5 bg-white shadow-lg rounded-lg w-48 left-1/2 -translate-x-1/2 top-16 lg:block lg:static lg:bg-transparent lg:shadow-none lg:w-auto">
                    <ul class="text-secondary ml-5 text-center lg:flex lg:space-x-6">
                        <li class="group">
                            <a href="{{ url('/') }}" class="text-semibold text-dark py-2 flex group-hover:text-primary">Beranda</a>
                        </li>
                        <li class="group">
                            <a href="{{ url('/kelas') }}" class="text-semibold text-dark py-2 flex group-hover:text-primary">Program Kami</a>
                        </li>
                        <li class="group">
                            <a href="{{ route('kelaskeranjang') }}" class="text-semibold text-dark py-2 flex group-hover:text-primary">Keranjang</a>
                        </li>

                        @auth
                        <!-- Jika user sudah login -->
                        <li class="group relative">
                            <button id="profile-btn" class="flex items-center space-x-2">
                                <img src="{{ asset('img/profil.jpg') }}" alt="Profil" class="w-8 h-8 rounded-full">
                                <span class="hidden lg:block text-sm">
                                    {{ Auth::user()->name ?? 'Peserta' }}
                                </span>
                            </button>
                            <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-md rounded-lg">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-dark hover:bg-gray-200">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                        @else
                        <!-- Jika user belum login -->
                        <li class="group w-full lg:w-auto">
                            <a href="{{ route('login') }}" class="block text-semibold text-white bg-primary w-full lg:w-auto px-6 py-2 text-center rounded-lg hover:bg-orange-500 transition">
                                Masuk
                            </a>
                        </li>
                        <li class="group w-full lg:w-auto mt-2 lg:mt-0">
                            <a href="{{ url('/register') }}" class="block text-semibold text-white bg-primary w-full lg:w-auto px-6 py-2 text-center rounded-lg hover:bg-orange-500 transition">
                                Daftar
                            </a>
                        </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('profile-btn')?.addEventListener('click', function() {
        document.getElementById('dropdown-menu').classList.toggle('hidden');
    });
</script>