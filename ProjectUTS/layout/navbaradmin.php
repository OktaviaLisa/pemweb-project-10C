<?php session_start(); ?>
<header class="bg-secondary fixed top-0 left-0 w-full flex items-center shadow-md z-50">
    <div class="container mx-auto">
        <div class="flex items-center justify-between relative">
            <!-- Logo -->
            <div class="px-4">
                <a href="indexAdmin.php" class="font-bold text-lg text-white block py-4">UMKMGrow</a>
            </div>

            <!-- Menu Navigasi -->
            <div class="flex items-center px-4 space-x-4">
                <!-- Hamburger Button -->
                <button id="hamburger" name="hamburger" type="button" class="block lg:hidden focus:outline-none">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <!-- Navigation Menu -->
                <nav id="nav-menu" class="hidden absolute font-semibold py-5 shadow-lg rounded-lg w-48 left-1/2 -translate-x-1/2 top-16 lg:block lg:static lg:bg-transparent lg:shadow-none lg:w-auto">
                    <ul class="text-white text-center lg:flex lg:space-x-6">
                        <li class="group"><a href="indexAdmin.php" class="py-2 flex group-hover:text-primary">Beranda</a></li>
                        <li class="group"><a href="bootcampadmin.php" class="py-2 flex group-hover:text-primary">Bootcamp</a></li>
                        <li class="group"><a href="mentoringadmin.php" class="py-2 flex group-hover:text-primary">Mentoring</a></li>
                        <li class="group"><a href="eventadmin.php" class="py-2 flex group-hover:text-primary">Event</a></li>
                        <li class="group"><a href="pesertaadmin.php" class="py-2 flex group-hover:text-primary">Peserta</a></li>
                    </ul>
                </nav>

                <!-- Profil Dropdown -->
                <div class="relative">
                    <button id="profile-btn" class="focus:outline-none flex items-center space-x-2 text-white">
                        <svg class="w-8 h-8 rounded-full bg-white p-1 text-secondary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4 -4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4
                                     v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <span class="hidden lg:block text-sm">
                            Admin
                        </span>
                    </button>
                    <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden z-50">
                        <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    const profileBtn = document.getElementById('profile-btn');
    const dropdownMenu = document.getElementById('dropdown-menu');

    profileBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', function(e) {
        if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
