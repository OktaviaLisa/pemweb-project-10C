<?php include "layout/navbar.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Profil UMKMGrow</title>
</head>
<body>
    <!--HERO SECTION START-->
    <section id="home" class="pt-36 bg-orange-50 w-full min-h-screen">
        <div class="container"> 
        <div class = "flex flex-wrap">
        <div class ="w-full self-center px-4 lg:w-1/2"> 
        <h1  class = "text-3xl font-bold text-primary lg:text-5xl mb-1" > UMKMGrow</h1>
        <h2  class  = "text-2xl font-bold text-secondary mb-3 lg:text-2xl"> Awali Bisnismu Bersama Kami!</h2>
        <p class = "text-base font-medium text-black mb-10"> <span class = "font-bold text-primary"> UMKMGrow</span> adalah platform yang mendukung 
            pengembangan UMKM melalui mentoring bisnis, kelas pengembangan diri, dan informasi event seperti bazaar. 
            Dengan jaringan mentor berpengalaman, <span class = "font-bold text-primary">UMKMGrow </span> siap membantu pelaku usaha meningkatkan strategi bisnis dan daya saing. 🚀 </p>

        </div>  
        <div class = "w-full self-end px-4 lg:w-1/2">
            <div class = "mt-10 lg:mt-9 lg:right-0">
                <img src = "img/umkmgrow.png" alt="UmkmGrow" class = "max-w-full mx-auto"/>
            </div>
        </div>
    </div> 
</div> 
    </section>
    <!-- HERO SECTION FINIISH-->

    <!--ABOUT SECTION START-->
    <section id="about" class="pt-36 pb-32">
        <div class="container">
            <div class="w-full flex flex-col items-center">
                <h4 class="text-3xl font-bold text-secondary lg:text-4xl text-center">
                    Program 
                    <span class="text-primary lg:text-4xl">UMKMGrow</span>
                </h4>    
            </div>
                
            <div class="flex flex-wrap">
                <!-- Bagian Bootcamp -->
                
                <div class="w-full px-4 mb-10 lg:w-1/2">
                    <h2 class="text-2xl mt-10 font-bold text-primary lg:text-3xl mb-3">Bootcamp</h2>
                    <p class="text-base font-medium text-black">
                        Intensif live class bersama para mentor yang berpengalaman
                    </p>
                    <h2>✅ Belajar langsung dari mentor bisnis</h2>
                    <h3>✅ Peluang membangun kolaborasi bisnis</h3>
                    <h4>✅ Studi kasus nyata dari bisnis yang berkembang</h4>
                    <a href="kelas.php" class="mt-5 inline-block text-[14px] font-semibold text-white bg-secondary py-2 px-8 rounded-lg hover:shadow-lg hover:opacity-80 transition duration-300">
                        Lihat Kelas Bootcamp 
                    </a>
                </div>
                <div class="w-full self-end px-4 lg:w-1/2">
                    <div class="mt-10 lg:mt-9 lg:right-0">
                        <img src="img/bootcamp2.png" alt="Bootcamp" class="w-3/4 md:w-1/2 lg:w-1/2 max-w-full mx-auto"/>
                    </div>
                </div>
            </div>
    
            <!-- Bagian Privat Mentoring -->
            <div class="flex flex-wrap lg:flex-row-reverse mt-10">
                <div class="w-full px-4 mb-10 lg:w-1/2">
                    <h2 class="text-2xl font-bold text-primary lg:text-3xl mb-3 mt-5">Privat Mentoring</h2>
                    <p class="text-base font-medium text-black">
                        Ruang diskusi pribadi bersama mentor berpengalaman
                    </p>
                    <h2>✅ Sesi eksklusif dengan mentor bisnis</h2>
                    <h3>✅ Bimbingan strategi bisnis yang lebih fokus</h3>
                    <h4>✅ Networking & akses komunitas bisnis</h4>
                    <a href="#" class="mt-5 inline-block text-[14px] font-semibold text-white bg-secondary py-2 px-8 rounded-lg hover:shadow-lg hover:opacity-80 transition duration-300">
                        Lihat Kelas Private Mentoring 
                    </a>
                </div>
                <div class="w-full self-end px-4 lg:w-1/2">
                    <div class="mt-10 lg:mt-9 lg:right-0">
                        <img src="img/privat.png" alt="Privat Mentoring" class="w-3/4 md:w-1/2 lg:w-1/2 max-w-full mx-auto"/>
                    </div>
                </div>
            </div>

            <!--Bagian informasi bazar-->
            <div class="flex flex-wrap mt-10">
                <div class="w-full px-4 mb-10 lg:w-1/2">
                    <h2 class="text-2xl font-bold text-primary lg:text-3xl mb-3 mt-5">Informasi Bazar</h2>
                    <p class="text-base font-medium text-black">
                        Dapatkan informasi tentang berbagai bazar yang bisa diikuti untuk memasarkan produk UMKM-mu.
                    </p>
                    <h2>✅ Kesempatan memperluas pasar dan pelanggan</h2>
                    <h3>✅ Networking dengan pengusaha lain</h3>
                    <h4>✅ Promosi produk secara langsung ke calon pembeli</h4>
                    <a href="#" class="mt-5 inline-block text-[14px] font-semibold text-white bg-secondary py-2 px-8 rounded-lg hover:shadow-lg hover:opacity-80 transition duration-300">
                        Lihat Informasi Bazar 
                    </a>
                </div>
                <div class="w-full self-end px-4 lg:w-1/2">
                    <div class="mt-10 lg:mt-9 lg:right-0">
                        <img src="img/Bazar.png" alt="Informasi Bazar" class="w-3/4 md:w-1/2 lg:w-1/2 max-w-full mx-auto"/>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--TESTIMONI-->
    <section id="Testimoni" class="pt-36 pb-16 bg-orange-50">
        <div class="container">
            <div class="w-full px-4 mb-10">
                <div class="max-w-xl mx-auto text-center mb-16">
                    <h4 class="text-3xl font-bold text-secondary lg:text-4xl text-center">
                        Testimoni 
                        <span class="text-primary lg:text-4xl">UMKMGrow</span>
                    </h4>
                </div>

            </div>

            <div class="w-full mb-20 px-4 flex flex-wrap justify-center">
                <!-- Testimoni 1 -->
                <div class="mb-12 p-4 md:w-1/2 flex flex-col md:flex-row items-center">
                    <div class="rounded-md shadow-md overflow-hidden md:w-1/3 max-w-sm">
                        <img src="img/Testimoni.jpeg" alt="Testimoni" class="w-full">
                    </div>
                    <div class="md:w-2/3 md:pl-5">
                        <h3 class="text-base font-semibold text-primary mt-5 mb-3 md:mt-0">Anggun Putri</h3>
                        <p class="text-base">Para mentor di UMKMGrow sangat berpengalaman. Saya jadi lebih paham seputar bagaimana membangun bisnis dan mempertahankan bisnis di era seperti saat ini.</p>
                    </div>
                </div>
            
                <!-- Testimoni 2 -->
                <div class="mb-12 p-4 md:w-1/2 flex flex-col md:flex-row items-center">
                    <div class="rounded-md shadow-md overflow-hidden md:w-1/3 max-w-sm flex justify-center">
                        <img src="img/testimoni2.jpg" alt="Testimoni" class="w-full">
                    </div>
                    <div class="md:w-2/3 md:pl-5">
                        <h3 class="text-base font-semibold text-primary mt-5 mb-3 md:mt-0">Kartika Kirana</h3>
                        <p class="text-base">Setelah mengikuti bootcamp ini, saya lebih memahami cara mengelola keuangan bisnis dengan baik. Mentor-mentornya sangat membantu dan inspiratif!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "layout/footer.php" ?>
</body>
</html>