<?php
include 'koneksi.php'; // Koneksi ke database
include 'layout/navbar.php';

// Query untuk mengambil jumlah pendaftar berdasarkan kelas
$sql_chart = "SELECT c.namaKelas, COUNT(k.id) as jumlah_pendaftar 
              FROM kelaskeranjang k
              JOIN kelas c ON k.kelas_id = c.idKelas
              GROUP BY k.kelas_id";

$result_chart = $koneksi->query($sql_chart);

$kelas_labels = [];
$kelas_counts = [];

while ($row_chart = $result_chart->fetch_assoc()) {
    $kelas_labels[] = $row_chart['namaKelas'];
    $kelas_counts[] = $row_chart['jumlah_pendaftar'];
}

// Query untuk mengambil data tabel utama
$sql = "SELECT k.id, k.email, c.namaKelas, b.tanggal, b.harga 
        FROM kelaskeranjang k
        JOIN kelas c ON k.kelas_id = c.idKelas
        JOIN batch b ON k.batch_id = b.idbatch";

$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar</title>
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <section class="pt-36 pb-10 overflow-hidden">
        <div class="container">
            <h2 class="text-3xl font-bold text-secondary text-center mb-6">Daftar Kelas Kamu di <span class="text-primary"> UMKMGrow</span></h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th class="border p-3">No</th>
                            <th class="border p-3">Email</th>
                            <th class="border p-3">Kelas</th>
                            <th class="border p-3">Batch</th>
                            <th class="border p-3">Harga</th>
                            <th class="border p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='text-center'>";
                            echo "<td class='border p-3'>" . $no++ . "</td>";
                            echo "<td class='border p-3'>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td class='border p-3'>" . htmlspecialchars($row['namaKelas']) . "</td>";
                            echo "<td class='border p-3'>" . htmlspecialchars($row['tanggal'] ?? '-') . "</td>";
                            echo "<td class='border p-3'>" . htmlspecialchars($row['harga'] ?? '-') . "</td>";
                            echo "<td class='border p-3 flex justify-center space-x-2'>
                                <form action='edit.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                        <button type='submit' class='bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700'>Edit</button>
                                    </form>
                                    <form style='display:inline;'> <button type='button' class='bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700' onclick='openConfirmModal({$row['id']})'>Hapus</button> </form>
                        
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </section>

    <!-- Modal Konfirmasi Hapus -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
            <h3 class="text-xl font-bold mb-4">Konfirmasi Hapus</h3>
            <p class="mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="flex justify-between">
                <button id="deleteButton" class="bg-red-600 text-white px-4 py-2 rounded">Ya, Hapus</button>
                <button onclick="closeModal()" class="bg-secondary text-white px-4 py-2 rounded">Batal</button>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="mt-5 mb-20 flex flex-col md:flex-row items-center md:items-start justify-center gap-8">
        <!-- Chart -->
        <div class="max-w-xs mr-10">
            <h2 class="text-2xl font-bold text-secondary text-center mb-4">Grafik Kelas</h2>
            <canvas id="kelasChart"></canvas>
        </div>

        <!-- Daftar Jumlah Pendaftar -->
        <div class="max-w-xs ml-10 bg-white p-4 rounded shadow-lg border-2 border-secondary">
            <h2 class="text-xl font-bold text-secondary mb-4">Jumlah Pendaftar <span class = "font-bold text-primary">UMKMGrow </span></h2>
            <ul>
                <?php foreach ($kelas_labels as $index => $kelas) : ?>
                    <li class="flex justify-between border-b py-2">
                        <span><?= htmlspecialchars($kelas) ?></span>
                        <span class="font-bold text-secondary ml-7"><?= $kelas_counts[$index] ?> orang</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <script>
        // PIE CHART
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
                maintainAspectRatio: true, // Perbaikan agar proporsi tetap terjaga
                aspectRatio: 1 // Menjaga ukuran agar tidak terlalu besar
            }
        });

        // MODAL KONFIRMASI HAPUS
        let deleteId = null;

        function openConfirmModal(id) {
            deleteId = id;
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        document.getElementById('deleteButton').addEventListener('click', function() {
            if (deleteId !== null) {
                window.location.href = 'hapus.php?id=' + deleteId;
            }
        });
    </script>

    <script src="js/script.js"></script>
</body>
</html>

<?php 
$koneksi->close(); 
include 'layout/footer.php';
?>