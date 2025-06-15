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
                <nav id="nav-menu"
                    class="hidden absolute font-semibold py-5 bg-white shadow-lg rounded-lg w-60 right-4 top-16
                           lg:block lg:static lg:bg-transparent lg:shadow-none lg:w-auto lg:translate-x-0">
                    <ul class="flex flex-col items-start space-y-2 text-secondary text-left
                               lg:flex-row lg:items-center lg:space-y-0 lg:space-x-6">
                        <li class="group">
                            <a href="{{ url('/') }}" class="text-semibold text-dark py-2 flex group-hover:text-primary px-4 w-full">Beranda</a>
                        </li>
                        <li class="group">
                            <a href="{{ url('/kelas') }}" class="text-semibold text-dark py-2 flex group-hover:text-primary px-4 w-full">Program Kami</a>
                        </li>
                        <li class="group">
                            <a href="{{ route('kelaskeranjang') }}" class="text-semibold text-dark py-2 flex group-hover:text-primary px-4 w-full">Keranjang</a>
                        </li>

                        @auth
                        <!-- Jika user sudah login -->
                        <li class="group relative w-full lg:w-auto">
                            <button id="profile-btn" class="flex items-center space-x-2 px-4 py-2 w-full lg:w-auto">
                                <img src="{{ asset('img/profil.jpg') }}" alt="Profil" class="w-8 h-8 rounded-full">
                                
                                <!-- Username tampil di mobile -->
                                <span class="block lg:hidden text-sm text-dark">
                                    {{ Auth::user()->username ?? 'username' }}
                                </span>
                                
                                <!-- Username tampil di desktop -->
                                <span class="hidden lg:block text-sm text-dark">
                                    {{ Auth::user()->username ?? 'username' }}
                                </span>
                            </button>
                            <div id="dropdown-menu"
                                class="hidden absolute right-0 top-full mt-2 w-60 bg-white shadow-md rounded-lg z-50 lg:right-0 lg:w-48">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-dark hover:bg-gray-200">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                        @else
                        <!-- Jika user belum login -->
                        <li class="group px-4">
                            <a href="{{ route('login') }}"
                               class="block text-semibold text-white bg-primary w-fit px-6 py-2 text-center rounded-lg hover:bg-orange-500 transition mx-auto lg:mx-0">
                                Masuk
                            </a>
                        </li>
                        <li class="group mt-2 lg:mt-0 px-4">
                            <a href="{{ url('/register') }}"
                               class="block text-semibold text-white bg-primary w-fit px-6 py-2 text-center rounded-lg hover:bg-orange-500 transition mx-auto lg:mx-0">
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

<!-- Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Hamburger toggle
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');

    if (hamburger && navMenu) {
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('hidden');
        });
    }

    // Dropdown profile toggle
    const profileBtn = document.getElementById('profile-btn');
    const dropdownMenu = document.getElementById('dropdown-menu');

    if (profileBtn && dropdownMenu) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', function (e) {
            if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }
});
</script>