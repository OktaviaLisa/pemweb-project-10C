<?php
include 'koneksi.php';
include 'layout/navbar.php';

$email = $_SESSION['email'];

// Ambil data kelas yang didaftarkan oleh user
$sql = "SELECT k.id, k.email, c.namaKelas, c.jenis, b.tanggal, b.harga 
        FROM kelaskeranjang k
        JOIN kelas c ON k.kelas_id = c.idKelas
        JOIN batch b ON k.batch_id = b.idbatch
        WHERE k.email = '$email'";
$result = $koneksi->query($sql);

// Data untuk chart
$sql_chart = "SELECT c.namaKelas, COUNT(k.id) as jumlah_kelas 
              FROM kelaskeranjang k
              JOIN kelas c ON k.kelas_id = c.idKelas
              WHERE k.email = '$email'
              GROUP BY k.kelas_id";
$result_chart = $koneksi->query($sql_chart);

$kelas_labels = [];
$kelas_counts = [];

while ($row_chart = $result_chart->fetch_assoc()) {
    $kelas_labels[] = $row_chart['namaKelas'];
    $kelas_counts[] = $row_chart['jumlah_kelas'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Terdaftar</title>
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-secondary">
    <section class="pt-36 pb-10">
        <div class="container">
            <h2 class="text-3xl font-bold text-white text-center mb-6">Kelas yang Kamu Ikuti di <span class="text-primary">UMKMGrow</span></h2>
            <div class="overflow-x-auto">
                <?php if ($result->num_rows > 0): ?>
                    <!-- TABEL -->
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-primary text-white text-center">
                                <th class="border p-3">No</th>
                                <th class="border p-3">Email</th>
                                <th class="border p-3">Jenis Kelas</th>
                                <th class="border p-3">Kelas</th>
                                <th class="border p-3">Batch</th>
                                <th class="border p-3">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='text-center'>";
                                echo "<td class='border p-3 bg-white'>" . $no++ . "</td>";
                                echo "<td class='border p-3 bg-white'>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td class='border p-3 bg-white'>" . htmlspecialchars($row['jenis']) . "</td>";
                                echo "<td class='border p-3 bg-white'>" . htmlspecialchars($row['namaKelas']) . "</td>";
                                echo "<td class='border p-3 bg-white'>" . htmlspecialchars($row['tanggal'] ?? '-') . "</td>";
                                echo "<td class='border p-3 bg-white'>" . htmlspecialchars($row['harga'] ?? '-') . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- TOMBOL DOWNLOAD -->
                    <div class="text-center mt-6">
                        <button id="downloadPdf" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary/80">Download PDF</button>
                    </div>

                    <!-- CHART & INFO KELAS -->
                    <div class="mt-10 flex flex-col md:flex-row items-center md:items-start justify-center gap-8">
                        <div class="max-w-xs mr-10">
                            <h2 class="text-2xl font-bold text-white text-center mb-4">Grafik Kelas</h2>
                            <canvas id="kelasChart"></canvas>
                        </div>

                        <div class="max-w-xs ml-10 bg-white p-4 rounded shadow-lg border-2 border-primary">
                            <h2 class="text-xl font-bold text-secondary mb-4">Jumlah Kelas Terdaftar</h2>
                            <ul>
                                <?php foreach ($kelas_labels as $index => $kelas) : ?>
                                    <li class="flex justify-between border-b py-2">
                                        <span><?= htmlspecialchars($kelas) ?></span>
                                        <span class="font-bold text-secondary ml-7"><?= $kelas_counts[$index] ?> class</span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- TAMPILAN SAAT TIDAK ADA DATA -->
                    <div class="text-center bg-white p-8 rounded shadow-md">
                        <p class="text-lg text-gray-700 font-semibold">Tidak ada kelas yang terdaftar.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <?php if ($result->num_rows > 0): ?>
    <script>
        const ctx = document.getElementById('kelasChart').getContext('2d');
        const kelasChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($kelas_labels) ?>,
                datasets: [{
                    label: 'Banyak Kelas',
                    data: <?= json_encode($kelas_counts) ?>,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                    borderColor: ['#FFFFFF'],
                    borderWidth: 2
                }]
            },
            options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 1,
            plugins: {
            legend: {
            labels: {
                color: "#ffffff" // warna putih
            }
        }
    }
}

        });

        document.getElementById('downloadPdf').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');

            pdf.setFontSize(18);
            pdf.text("Laporan Kelas yang Diikuti - UMKMGrow", 14, 20);

            html2canvas(document.querySelector("table")).then(canvas => {
                const imgData = canvas.toDataURL("image/png");
                pdf.addImage(imgData, 'PNG', 10, 30, 190, 0);

                html2canvas(document.getElementById("kelasChart")).then(canvas => {
                    const imgChart = canvas.toDataURL("image/png");
                    pdf.addPage();
                    pdf.text("Grafik Kelas", 14, 20);
                    pdf.addImage(imgChart, 'PNG', 50, 30, 100, 100);
                    pdf.save("laporan_kelas.pdf");
                });
            });
        });
    </script>
    <?php endif; ?>
</body>
</html>

<?php 
$koneksi->close(); 
include 'layout/footer.php';
?>
