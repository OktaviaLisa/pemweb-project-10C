<?php
session_start();
include 'koneksi.php';

// Hitung jumlah kelas
$queryKelas = "SELECT COUNT(*) as total FROM kelas WHERE jenis='bootcamp'";
$resultKelas = $koneksi->query($queryKelas);
$rowKelas = $resultKelas->fetch_assoc();
$totalKelas = $rowKelas['total'];

// Hitung jumlah private mentoring
$queryMentoring = "SELECT COUNT(*) as total FROM kelas WHERE jenis='private mentoring'";
$resultMentoring = $koneksi->query($queryMentoring);
$rowMentoring = $resultMentoring->fetch_assoc();
$totalMentoring = $rowMentoring['total'];

// Hitung jumlah peserta
$queryPeserta = "SELECT COUNT(*) as total FROM users";
$resultPeserta = $koneksi->query($queryPeserta);
$rowPeserta = $resultPeserta->fetch_assoc();
$totalPeserta = $rowPeserta['total'];

// Hitung jumlah event
$queryEvent = "SELECT COUNT(*) as total FROM infoevent";
$resultEvent = $koneksi->query($queryEvent);
$rowEvent = $resultEvent->fetch_assoc();
$totalEvent = $rowEvent['total'];

// Ambil data grafik batang jumlah pendaftar per kelas
$queryGrafik = "
    SELECT kelas.namaKelas, COUNT(kelaskeranjang.id) AS jumlah
    FROM kelaskeranjang
    JOIN kelas ON kelas.idKelas = kelaskeranjang.kelas_id
    GROUP BY kelas.namaKelas
";
$resultGrafik = $koneksi->query($queryGrafik);

$labels = [];
$data = [];

while ($row = $resultGrafik->fetch_assoc()) {
    $labels[] = $row['namaKelas'];
    $data[] = $row['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-secondary container mx-auto">
    <h2 class="text-3xl font-bold text-center text-white p-6 mb-6">Dashboard Admin</h2>

    <!-- Kotak Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Kotak Bootcamp -->
        <div class="bg-white rounded-lg shadow-md border-3 border-primary flex flex-col justify-between">
            <div class="flex items-center p-6">
                <div class="mr-4">
                    <h2 class="text-xl font-semibold text-black">Bootcamp</h2>
                    <p class="text-black">Jumlah Bootcamp</p>
                    <p class="text-3xl font-bold text-primary"><?php echo $totalKelas; ?></p>
                </div>
                <img src="img/bootcamp.png" alt="Kelas Image" class="w-24 h-24 object-cover ml-auto">
            </div>
            <a href="bootcampadmin.php" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-primary hover:bg-opacity-90 transition">
                Informasi selanjutnya
            </a>
        </div>

        <!-- Kotak Private Mentoring -->
        <div class="bg-white rounded-lg shadow-md border-3 border-red-500 flex flex-col justify-between">
            <div class="flex items-center p-6">
                <div class="mr-4">
                    <h2 class="text-xl font-semibold text-black">Private Mentoring</h2>
                    <p class="text-black">Jumlah Private Mentoring</p>
                    <p class="text-3xl font-bold text-primary"><?php echo $totalMentoring; ?></p>
                </div>
                <img src="img/mentoring.png" alt="Batch Image" class="w-24 h-24 object-cover ml-auto">
            </div>
            <a href="mentoringadmin.php" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-primary hover:bg-opacity-90 transition">
                Informasi selanjutnya
            </a>
        </div>

        <!-- Kotak Private Mentoring -->
        <div class="bg-white rounded-lg shadow-md border-3 border-red-500 flex flex-col justify-between">
            <div class="flex items-center p-6">
                <div class="mr-4">
                    <h2 class="text-xl font-semibold text-black">Event</h2>
                    <p class="text-black">Jumlah Event</p>
                    <p class="text-3xl font-bold text-primary"><?php echo $totalEvent; ?></p>
                </div>
                <img src="img/mentoring.png" alt="Batch Image" class="w-24 h-24 object-cover ml-auto">
            </div>
            <a href="eventadmin.php" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-primary hover:bg-opacity-90 transition">
                Informasi selanjutnya
            </a>
        </div>

        <!-- Kotak Peserta -->
        <div class="bg-white rounded-lg shadow-md border-3 border-green-500 flex flex-col justify-between">
            <div class="flex items-center p-6">
                <div class="mr-4">
                    <h2 class="text-xl font-semibold text-black">Peserta</h2>
                    <p class="text-black">Jumlah Peserta</p>
                    <p class="text-3xl font-bold text-primary"><?php echo $totalPeserta; ?></p>
                </div>
                <img src="img/peserta.png" alt="Peserta Image" class="w-24 h-24 object-cover ml-auto">
            </div>
            <a href="pesertaAdmin.php" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-primary hover:bg-opacity-90 transition">
                Informasi selanjutnya
            </a>
        </div>
    </div>

    <!-- Grafik Jumlah Pendaftar -->
    <div class="bg-white p-6 rounded-lg shadow-md max-w-5xl mx-auto mb-12">
        <h2 class="text-xl font-semibold text-center text-black mb-4">Grafik Jumlah Pendaftar per Kelas</h2>
        <canvas id="kelasChart" height="100"></canvas>
    </div>

    <!-- Script Chart -->
    <script>
    const ctx = document.getElementById('kelasChart').getContext('2d');
    const kelasChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Jumlah Pendaftar',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(59, 130, 246, 0.6)', // warna primary-ish
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Pendaftar'
                    },
                    ticks: {
                        stepSize: 1,
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nama Kelas'
                    }
                }
            }
        }
    });
    </script>

</body>
</html>