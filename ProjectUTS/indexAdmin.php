<?php
session_start();
include 'koneksi.php';
include "layout/navbaradmin.php";

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

// Hitung total pendapatan
$queryPendapatan = "
    SELECT SUM(batch.harga) AS totalPendapatan
    FROM kelaskeranjang
    JOIN batch ON kelaskeranjang.batch_id = batch.idBatch
";
$resultPendapatan = $koneksi->query($queryPendapatan);
$rowPendapatan = $resultPendapatan->fetch_assoc();
$totalPendapatan = $rowPendapatan['totalPendapatan'] ?? 0;

// Hitung pendapatan Bootcamp
$queryBootcamp = "
    SELECT SUM(batch.harga) AS pendapatanBootcamp
    FROM kelaskeranjang
    JOIN batch ON kelaskeranjang.batch_id = batch.idBatch
    JOIN kelas ON batch.idKelas = kelas.idKelas
    WHERE kelas.jenis = 'Bootcamp'
";
$resultBootcamp = $koneksi->query($queryBootcamp);
$rowBootcamp = $resultBootcamp->fetch_assoc();
$pendapatanBootcamp = $rowBootcamp['pendapatanBootcamp'] ?? 0;

// Hitung pendapatan Private Mentoring
$queryMentoring = "
    SELECT SUM(batch.harga) AS pendapatanMentoring
    FROM kelaskeranjang
    JOIN batch ON kelaskeranjang.batch_id = batch.idBatch
    JOIN kelas ON batch.idKelas = kelas.idKelas
    WHERE kelas.jenis = 'Private Mentoring'
";
$resultMentoring = $koneksi->query($queryMentoring);
$rowMentoring = $resultMentoring->fetch_assoc();
$pendapatanMentoring = $rowMentoring['pendapatanMentoring'] ?? 0;


// Data untuk chart bootcamp
$queryBootcamp = "
    SELECT kelas.namaKelas, COUNT(kelaskeranjang.id) AS jumlah
    FROM kelas
    LEFT JOIN kelaskeranjang ON kelas.idKelas = kelaskeranjang.kelas_id
    WHERE kelas.jenis = 'Bootcamp'
    GROUP BY kelas.namaKelas
";

$resultBootcamp = $koneksi->query($queryBootcamp);
$labelsBootcamp = [];
$dataBootcamp = [];
while ($row = $resultBootcamp->fetch_assoc()) {
    $labelsBootcamp[] = $row['namaKelas'];
    $dataBootcamp[] = $row['jumlah'];
}

// Data untuk chart private mentoring
$queryMentoring = "
    SELECT kelas.namaKelas, COUNT(kelaskeranjang.id) AS jumlah
    FROM kelas
    LEFT JOIN kelaskeranjang ON kelas.idKelas = kelaskeranjang.kelas_id
    WHERE kelas.jenis = 'Private Mentoring'
    GROUP BY kelas.namaKelas
";
$resultMentoringChart = $koneksi->query($queryMentoring);
$labelsMentoring = [];
$dataMentoring = [];
while ($row = $resultMentoringChart->fetch_assoc()) {
    $labelsMentoring[] = $row['namaKelas'];
    $dataMentoring[] = $row['jumlah'];
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body class="bg-gray-100 container mx-auto">

<div id="dashboardContent" class="pt-24">
    <!--Master Admin Section-->
    <section>
        <h2 class="text-3xl font-bold text-center text-primary p-6 mb-6">Dashboard Admin</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Kotak Bootcamp -->
            <div class="bg-white rounded-lg shadow-md flex flex-col justify-between">
                <div class="flex items-center justify-between p-6 h-40">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-secondary">Bootcamp</h2>
                        <p class="text-black">Jumlah Bootcamp</p>
                        <p class="text-3xl font-bold text-primary"><?php echo $totalKelas; ?></p>
                    </div>
                    <img src="img/bazar.png" alt="Kelas Image" class="w-24 h-24 object-cover">
                </div>
                <a href="bootcampadmin.php" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-primary hover:bg-opacity-90 transition">
                    Informasi selanjutnya
                </a>
            </div>

            <!-- Kotak Private Mentoring -->
            <div class="bg-white rounded-lg shadow-md flex flex-col justify-between">
                <div class="flex items-center justify-between p-6 h-40">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-secondary">Private Mentoring</h2>
                        <p class="text-black">Jumlah Private Mentoring</p>
                        <p class="text-3xl font-bold text-primary"><?php echo $totalMentoring; ?></p>
                    </div>
                    <img src="img/bazar.png" alt="Mentoring Image" class="w-24 h-24 object-cover">
                </div>
                <a href="mentoringadmin.php" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-primary hover:bg-opacity-90 transition">
                    Informasi selanjutnya
                </a>
            </div>

            <!-- Kotak Event -->
            <div class="bg-white rounded-lg shadow-md border-3 flex flex-col justify-between">
                <div class="flex items-center justify-between p-6 h-40">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-secondary">Event</h2>
                        <p class="text-black">Jumlah Event</p>
                        <p class="text-3xl font-bold text-primary"><?php echo $totalEvent; ?></p>
                    </div>
                    <img src="img/bazar.png" alt="Event Image" class="w-24 h-24 object-cover">
                </div>
                <a href="eventadmin.php" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-primary hover:bg-opacity-90 transition">
                    Informasi selanjutnya
                </a>
            </div>

            <!-- Kotak Peserta -->
            <div class="bg-white rounded-lg shadow-md flex flex-col justify-between">
                <div class="flex items-center justify-between p-6 ">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-secondary">Peserta</h2>
                        <p class="text-black">Jumlah Peserta</p>
                        <p class="text-3xl font-bold text-primary"><?php echo $totalPeserta; ?></p>
                    </div>
                    <img src="img/bazar.png" alt="Peserta Image" class="w-24 h-24 object-cover">
                </div>
                <a href="pesertaadmin.php" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-primary hover:bg-opacity-90 transition">
                    Informasi selanjutnya
                </a>
            </div>
        </div>
    </section>

    <!-- Pendapatan Section -->
    <section>
        <h2 class="text-3xl font-bold text-center text-primary mb-6">Grafik Pendaftar Bootcamp</h2>
        <div class="grid grid-cols-2 max-w-5xl mx-auto gap-6 mb-12">
            <!-- Kotak Total Pendapatan -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                <h2 class="text-xl font-semibold text-secondary mb-2">Total Pendapatan</h2>
                <p class="text-black">Keseluruhan:</p>
                <p class="text-3xl font-bold text-secondary mt-2">Rp<?php echo number_format($totalPendapatan, 0, ',', '.'); ?></p>
            </div>

            <!-- Kotak Detail Pendapatan -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                <h2 class="text-xl font-semibold text-secondary mb-2">Rincian Pendapatan</h2>
                <div class="flex flex-col gap-2 text-black">
                    <div class="flex justify-between">
                        <p>Bootcamp:</p>
                        <p class="font-semibold text-secondary">Rp<?php echo number_format($pendapatanBootcamp, 0, ',', '.'); ?></p>
                    </div>
                    <div class="flex justify-between">
                        <p>Private Mentoring:</p>
                        <p class="font-semibold text-secondary">Rp<?php echo number_format($pendapatanMentoring, 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chart Section-->
    <section class="pt-4">
        <!-- Chart bootcamp -->
        <h2 class="text-3xl font-bold text-center text-primary mb-6">Grafik Pendaftar Bootcamp</h2>
        <div class="bg-white p-6 rounded-lg shadow-md max-w-5xl mx-auto mb-2">
            <canvas id="bootcampChart" height="100"></canvas>
        </div>
        <!--Detail chart-->
        <div class="bg-white mt-7 p-6 rounded-lg shadow-md max-w-5xl mx-auto mb-12">
            <h3 class="text-xl text-center font-semibold text-gray-800 mb-4">Keterangan Jumlah Pendaftar Bootcamp:</h3>
            <div class="overflow-x-auto">
                <table class="table-auto mx-auto text-center text-gray-700 border-collapse border border-gray-300 w-full md:w-2/3">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th class="py-2 px-4 border border-gray-300">Nama Kelas</th>
                            <th class="py-2 px-4 border border-gray-300">Jumlah Pendaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($labelsBootcamp as $index => $label): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border border-gray-300 font-semibold"><?php echo $label; ?></td>
                                <td class="py-2 px-4 border border-gray-300"><?php echo $dataBootcamp[$index]; ?> pendaftar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chart private mentoring -->
        <h2 class="text-3xl font-bold text-center text-primary mb-6">Grafik Pendaftar Private Mentoring</h2>
        <div class="bg-white p-6 rounded-lg shadow-md max-w-5xl mx-auto mb-2">
            <canvas id="mentoringChart" height="100"></canvas>
        </div>
        <!-- Detail Chart-->
        <div class="bg-white mt-7 p-6 rounded-lg shadow-md max-w-5xl mx-auto mb-12">
            <h3 class="text-xl text-center font-semibold text-gray-800 mb-4">Keterangan Jumlah Pendaftar Private Mentoring:</h3>
            <div class="overflow-x-auto">
                <table class="table-auto mx-auto text-center text-gray-700 border-collapse border border-gray-300 w-full md:w-2/3">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th class="py-2 px-4 border border-gray-300">Nama Kelas</th>
                            <th class="py-2 px-4 border border-gray-300">Jumlah Pendaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($labelsMentoring as $index => $label): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border border-gray-300 font-semibold"><?php echo $label; ?></td>
                            <td class="py-2 px-4 border border-gray-300"><?php echo $dataMentoring[$index]; ?> pendaftar</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Button Download Report -->
    <div class="text-center mb-16">
            <button onclick="downloadDashboard()" class="bg-primary text-white font-semibold px-6 py-3 rounded hover:bg-opacity-90 transition">
                Download Report
            </button>
    </div>
</div>

<script>
    const bootcampCtx = document.getElementById('bootcampChart').getContext('2d');
    new Chart(bootcampCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labelsBootcamp); ?>,
            datasets: [{
                label: 'Jumlah Pendaftar Bootcamp',
                data: <?php echo json_encode($dataBootcamp); ?>,
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    const mentoringCtx = document.getElementById('mentoringChart').getContext('2d');
    new Chart(mentoringCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labelsMentoring); ?>,
            datasets: [{
                label: 'Jumlah Pendaftar Private Mentoring',
                data: <?php echo json_encode($dataMentoring); ?>,
                backgroundColor: 'rgba(234, 88, 12, 0.6)',
                borderColor: 'rgba(234, 88, 12, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    async function downloadDashboard() {
        const { jsPDF } = window.jspdf;
        const content = document.getElementById('dashboardContent');
        const button = document.querySelector('button[onclick="downloadDashboard()"]');

        // Sembunyikan tombol dan elemen yang tidak ingin dicetak
        button.style.display = 'none';
        const title = document.querySelector('h2.text-3xl');
        const statBoxes = document.querySelector('.grid');

        title.style.display = 'none';
        statBoxes.style.display = 'none';

        // Ambil tangkapan layar
        const canvas = await html2canvas(content, {
            scale: 2,
            useCORS: true,
            backgroundColor: '#ffffff'
        });

        // Tampilkan kembali elemen yang disembunyikan
        button.style.display = 'inline-block';
        title.style.display = '';
        statBoxes.style.display = 'grid';

        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'mm', 'a4');
        const pageWidth = 210;
        const pageHeight = 297;
        const margin = 30;
        const usableWidth = pageWidth - margin * 2;
        const imgProps = pdf.getImageProperties(imgData);
        const imgWidth = usableWidth;
        const imgHeight = (imgProps.height * imgWidth) / imgProps.width;
        let yPosition = margin;

        pdf.setFont("helvetica", "bold");
        pdf.setFontSize(16);
        pdf.text("Laporan UMKMGrow", pageWidth / 2, yPosition, { align: "center" });

        yPosition += 10;

        if (imgHeight + yPosition > pageHeight - margin) {
            let remainingHeight = imgHeight;
            let position = yPosition;
            const imgHeightPerPage = pageHeight - yPosition - margin;
            let page = 0;
            while (remainingHeight > 0) {
                if (page > 0) {
                    pdf.addPage();
                    position = margin;
                }

                const sourceCanvas = document.createElement("canvas");
                const scale = imgWidth / canvas.width;
                sourceCanvas.width = canvas.width;
                sourceCanvas.height = imgHeightPerPage / scale;

                const ctx = sourceCanvas.getContext("2d");
                ctx.drawImage(
                    canvas,
                    0,
                    (imgHeightPerPage / scale) * page,
                    canvas.width,
                    imgHeightPerPage / scale,
                    0,
                    0,
                    canvas.width,
                    imgHeightPerPage / scale
                );

                const partialImg = sourceCanvas.toDataURL("image/png");
                pdf.addImage(partialImg, "PNG", margin, position, imgWidth, imgHeightPerPage);
                remainingHeight -= imgHeightPerPage;
                page++;
            }
        } else {
            pdf.addImage(imgData, 'PNG', margin, yPosition, imgWidth, imgHeight);
        }

        pdf.save("laporan-umkmgrow.pdf");
    }
</script>

</body>
</html>