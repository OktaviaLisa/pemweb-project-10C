@include('components.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Profil UMKMGrow</title>
</head>
<body>
 
   <!-- HERO SECTION START -->
   <section id="home" class="pt-24 bg-secondary w-full min-h-screen flex items-center">
        <div class="container mx-auto flex flex-col-reverse lg:flex-row items-center px-4">
            <div class="w-full lg:w-1/2 text-center lg:text-left">
            <h1  class = "text-3xl font-bold text-white lg:text-5xl mb-1" > UMKMGrow</h1>
            <h2  class  = "text-2xl font-bold text-primary mb-3 lg:text-2xl"> Awali Bisnismu Bersama Kami!</h2>
            <p class = "text-base font-medium text-white mb-10"> <span class = "font-bold text-white"> UMKMGrow</span> adalah platform yang mendukung 
            pengembangan UMKM melalui mentoring bisnis, kelas pengembangan diri, dan informasi event seperti bazaar. 
            Dengan jaringan mentor berpengalaman, <span class = "font-bold text-white">UMKMGrow </span> siap membantu pelaku usaha meningkatkan strategi bisnis dan daya saing. 🚀 </p>
            <a href="#about" class = "text-base font-semibold text-white bg-primary py-3 px-8 rounded-lg hover:bg-orange-500 transition">Lihat Program</a>
            </div>
            <div class="w-full lg:w-1/2 flex justify-center">
                <img src="img/cover2.png" alt="UMKMGrow" class="w-3/4 lg:w-full max-w-md">
            </div>

        </div>
        
    </section>
<!-- HERO SECTION FINISH -->

<!-- BENEFIT SECTION START -->
<section id="benefit" class="py-10 bg-secondary">
    <div class="container mx-auto px-6">    

        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center items-center">
                
                <!-- Benefit Title (di dalam kotak putih) -->
                <div class="md:col-span-1 flex items-center justify-center">
                    <h3 class="text-2xl font-bold text-secondary lg:text-2xl">Benefit 
                    <p class = "text-2x1 font-bold text-primary lg:text-2xl"> UMKMGrow</p></h3>
                </div>

                <!-- Benefit Cards -->
                <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Mentor Berpengalaman -->
                    <div>
                        <img src="img/privaticon.png" alt="Mentor Berpengalaman" class="mx-auto mb-3 w-16">
                        <h3 class="text-lg font-bold text-primary">Mentor Berpengalaman</h3>
                        <p class="text-sm font-medium text-gray-700">Belajar langsung dari mentor bisnis profesional</p>
                    </div>

                    <!-- Kelas Gratis -->
                    <div>
                        <img src="img/kelasicon.png" alt="Kelas Gratis" class="mx-auto mb-3 w-16">
                        <h3 class="text-lg font-bold text-primary">Kelas Gratis</h3>
                        <p class="text-sm font-medium text-gray-700">Coba beberapa kelas sebelum membeli program</p>
                    </div>

                    <!-- Sertifikat Resmi -->
                    <div>
                        <img src="img/sertifikaticon.png" alt="Sertifikat Resmi" class="mx-auto mb-3 w-16">
                        <h3 class="text-lg font-bold text-primary">Sertifikat Resmi</h3>
                        <p class="text-sm font-medium text-gray-700">Dapatkan sertifikat setelah menyelesaikan program</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- BENEFIT SECTION FINISH -->

    <!--ABOUT SECTION START-->
    <section id="about" class="pt-36 pb-32 bg-secondary">
    <div class="container mx-auto px-6">
        <div class="w-full text-center mt-2 mb-10">
            <h4 class="text-3xl font-bold text-white lg:text-4xl">
                Program <span class="text-orange-50">UMKMGrow</span>
            </h4>    
        </div>

        <!-- Menggunakan grid agar lebih fleksibel di berbagai ukuran layar -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Bootcamp -->
            <div class="flex flex-col items-center text-center bg-white shadow-lg rounded-2xl p-6 max-w-sm mx-auto">
                <img src="img/bootcamp2.png" alt="Bootcamp" class="w-50 h-40 mb-4">
                <h2 class="text-xl font-bold text-secondary">Bootcamp</h2>
                <p class="text-base text-black">Intensif live class bersama para mentor yang berpengalaman.</p>
                <a href="kelas" class="mt-3 inline-block text-sm font-semibold text-white bg-primary py-2 px-6 rounded-lg hover:shadow-lg hover:opacity-80 transition duration-300">
                    Lihat Selengkapnya
                </a>
            </div>

            <!-- Privat Mentoring -->
            <div class="flex flex-col items-center text-center bg-white shadow-lg rounded-2xl p-6 max-w-sm mx-auto">
                <img src="img/privat.png" alt="Privat Mentoring" class="w-50 h-40 mb-4">
                <h2 class="text-xl font-bold text-secondary">Privat Mentoring</h2>
                <p class="text-base text-black">Ruang diskusi pribadi bersama mentor berpengalaman.</p>
                <a href="kelas" class="mt-3 inline-block text-sm font-semibold text-white bg-primary py-2 px-6 rounded-lg hover:shadow-lg hover:opacity-80 transition duration-300">
                    Lihat Selengkapnya
                </a>
            </div>

            <!-- Informasi Bazar -->
            <div class="flex flex-col items-center text-center bg-white shadow-lg rounded-2xl p-6 max-w-sm mx-auto">
                <img src="img/Bazar.png" alt="Informasi Bazar" class="w-50 h-40 mb-4">
                <h2 class="text-xl font-bold text-secondary">Informasi Event</h2>
                <p class="text-base text-black">Dapatkan informasi bazar untuk memasarkan produk UMKM-mu.</p>
                <a href="kelas" class="mt-3 inline-block text-sm font-semibold text-white bg-primary py-2 px-6 rounded-lg hover:shadow-lg hover:opacity-80 transition duration-300">
                    Lihat Selengkapnya
                </a>
            </div>

        </div>
    </div>
</section>


    <!--TESTIMONI-->
<section id="Testimoni" class="py-16 bg-secondary">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-white mb-6">Testimoni UMKMGrow</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        
            <!-- Testimoni 1 -->
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-sm mx-auto">
            <img src="img/Testimoni1.png" alt="Testimoni 1" class="w-full h-auto object-cover aspect-square rounded-lg">
        </div>

        
            <!-- Testimoni 1 -->
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-sm mx-auto">
            <img src="img/Testimoni2.png" alt="Testimoni 1" class="w-full h-auto object-cover aspect-square rounded-lg">
        </div>

        
            <!-- Testimoni 1 -->
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-sm mx-auto">
            <img src="img/Testimoni3.png" alt="Testimoni 1" class="w-full h-auto object-cover aspect-square rounded-lg">
        </div>

        </div>
    </div>
</section>

<!-- FAQ SECTION START -->
<section id="faq" class="py-16 bg-secondary">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-white mb-6">Yang Sering Ditanyakan</h2>
        <div class="space-y-4 max-w-2xl mx-auto">
            <details class="border border-gray-300 bg-white rounded-lg p-4 cursor-pointer">
                <summary class="font-semibold text-primary text-lg">Apa itu UMKMGrow?</summary>
                <p class="text-black mt-2">UMKMGrow adalah platform yang membantu UMKM dalam pengembangan bisnis melalui mentoring, bootcamp, dan event.</p>
            </details>
            <details class="border border-gray-300 bg-white rounded-lg p-4 cursor-pointer">
                <summary class="font-semibold text-primary text-lg">Apa saja fitur di UMKMGrow?</summary>
                <p class="text-black mt-2">Fitur utama UMKMGrow meliputi bootcamp bisnis, mentoring privat, dan informasi bazar UMKM.</p>
            </details>
            <details class="border border-gray-300  bg-white rounded-lg p-4 cursor-pointer">
                <summary class="font-semibold text-primary text-lg">Apakah UMKMGrow berbayar?</summary>
                <p class="text-black mt-2">Beberapa kelas di UMKMGrow gratis, tetapi untuk fitur privat mentoring dan berberapa kelas berbayar.</p>
            </details>
            <details class="border border-gray-300  bg-white rounded-lg p-4 cursor-pointer">
                <summary class="font-semibold text-primary text-lg">Bagaimana cara bergabung dengan UMKMGrow?</summary>
                <p class="text-black mt-2">Kamu dapat mendaftar melalui website kami dan memilih program yang sesuai dengan kebutuhan bisnis Anda.</p>
            </details>
            <details class="border border-gray-300  bg-white rounded-lg p-4 cursor-pointer">
                <summary class="font-semibold  text-primary text-lg">Kemana saya bisa mendapatkan informasi lebih lanjut?</summary>
                <p class="text-black mt-2">Silakan kunjungi halaman kontak kami atau hubungi kami melalui email dan media sosial.</p>
            </details>
        </div>
    </div>
</section>
<!-- FAQ SECTION FINISH -->

@include('components.footer')
</body>
</html>