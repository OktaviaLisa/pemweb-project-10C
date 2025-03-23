<header class="bg-white fixed top-0 left-0 w-full flex items-center shadow-md z-50">
    <div class="container mx-auto">
        <div class="flex items-center justify-between relative">
            <!-- Logo -->
            <div class="px-4">
                <a href="index.php" class="font-bold text-lg text-primary block py-4">UMKMGrow</a>
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
                    <ul class="text-secondary text-center space-y-2 lg:flex lg:space-y-0 lg:space-x-6">
                        <li class="group">
                            <a href="index.php" class="text-base text-dark ml-7 py-2 flex group-hover:text-primary">Beranda</a>
                        </li>
                        <li class="group">
                            <a href="kelas.php" class="text-base text-dark ml-7 py-2 flex group-hover:text-primary">Program Kami</a>
                        </li>
                        <li class="group">
                            <a href="kelasterdaftar.php" class="text-base text-dark ml-7 py-2 flex group-hover:text-primary">Keranjang</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- Pastikan script ini berada di bawah navbar -->
<script src="js/script.js"></script>
<script src="https://kit.fontawesome.com/7198f0d2d5.js" crossorigin="anonymous"></script>