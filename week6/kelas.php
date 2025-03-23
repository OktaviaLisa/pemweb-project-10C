<?php include "layout/navbar.php" ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Kelas Digital Marketing</title>
</head>

<body class="bg-orange-50">
    <div class="max-w-6xl mx-auto px-6 py-10">
        <div class="bg-white rounded-lg shadow-lg mt-20 p-6 flex flex-wrap items-center">
            <!-- Gambar Kelas -->
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="img/DigitalMarketing.png" alt="Digital Marketing Bootcamp" class="rounded-lg w-full md:w-3/4 lg:w-3/4 max-w-full mx-auto">
            </div>

            <!-- Informasi Kelas -->
            <div class="w-full lg:w-1/2 lg:pl-10 mt-6 lg:mt-0">
                <h1 class="text-3xl mt-7 font-bold text-secondary">Digital Marketing</h1>
                <p class=" font-medium"> Kelas Digital Marketing adalah program pelatihan yang dirancang untuk 
                    membantu peserta memahami strategi pemasaran digital secara mendalam. 
                </p>

                <div class="mt-4 bg-white shadow-md rounded-lg p-4 w-72">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-cyan-600">Batch 1</span>
                        <span class="text-red-500 text-sm font-bold">Terbatas</span>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">Rp 250.000</p>
                    <p class="text-gray-700 text-sm mt-2">16 Mei 2025 - 9 Juli 2025</p>
                </div>

                <div class="mt-4 bg-white shadow-md rounded-lg p-4 w-72">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-cyan-600">Batch 2</span>
                        <span class="text-red-500 text-sm font-bold">Terbatas</span>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">Rp 250.000</p>
                    <p class="text-gray-700 text-sm mt-2">20 juli Mei 2025 - 30 Agustus 2025</p>
                </div>

                <a href="daftar.php" class="mt-6 inline-block bg-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-orange-500 transition">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
    <?php include "layout/footer.php" ?>
</body>
</html>
