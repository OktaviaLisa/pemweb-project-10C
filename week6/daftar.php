<?php
include 'koneksi.php';
include 'layout/navbar.php'; 

// Ambil data kelas
$sql_kelas = "SELECT idKelas, namaKelas FROM kelas";
$result_kelas = $koneksi->query($sql_kelas);

// Ambil data batch dengan join ke tabel kelas
$sql_batch = "SELECT idbatch, tanggal, harga, idKelas FROM batch";
$result_batch = $koneksi->query($sql_batch);

// Simpan batch dalam array asosiatif agar bisa diakses lewat JavaScript
$batch_data = [];
while ($row = $result_batch->fetch_assoc()) {
    $batch_data[$row['idKelas']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Daftar Kelas</title>
</head>
<body>

<section id="pendaftaran" class="pt-36 pb-32">
    <div class="container">
        <div class="w-full px-4">
            <div class="max-w-xl mx-auto text-center mb-16">
                <h2 class="font-bold text-secondary text-3xl mb-4 sm:text-4xl">
                    PENDAFTARAN PROGRAM <span class="text-primary">UMKMGrow</span>
                </h2>
                <p class="font-semibold text-black text-md md:text-lg">
                    Bergabung dengan program eksklusif dan mulai awali bisnismu!
                </p>
            </div>
        </div>
    </div>

    <!-- Formulir Pendaftaran -->
    <form action="prosesdaftar.php" method="POST">
        <div class="w-full lg:w-2/3 lg:mx-auto">          
            
            <!-- Email -->
            <div class="w-full px-6 md-8 mb-5">
                <label for="email" class="text-base font-bold text-secondary">Email</label>
                <input type="email" id="email" name="email" class="w-full bg-slate-200 text-black p-3 rounded-md focus:outline-none focus:ring-secondary focus:ring-1 focus:border-secondary" required />
            </div>

            <!-- Pilih Kelas -->
            <div class="w-full px-6 md-8 mb-5">
                <label for="kelas" class="text-base font-bold text-secondary">Pilih Kelas</label>
                <select id="kelas" name="kelas_id" class="w-full bg-slate-200 text-black p-3 rounded-md focus:outline-none focus:ring-secondary focus:ring-1 focus:border-secondary" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    <?php while($row = $result_kelas->fetch_assoc()): ?>
                        <option value="<?= $row['idKelas'] ?>">
                            <?= $row['namaKelas'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Pilih Batch -->
            <div class="w-full px-6 md-8 mb-5">
                <label for="batch" class="text-base font-bold text-secondary">Pilih Batch</label>
                <select id="batch" name="batch_id" class="w-full bg-slate-200 text-black p-3 rounded-md focus:outline-none focus:ring-secondary focus:ring-1 focus:border-secondary" required>
                    <option value="" disabled selected>Pilih Batch</option>
                </select>
            </div>

            <div class="w-full px-6 md-8 mb-5">
                <label for="harga" class="text-base font-bold text-secondary">Harga</label>
                <input type="text" id="harga" name="harga" class="w-full bg-slate-200 text-black p-3 rounded-md focus:outline-none" readonly />
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-between items-center mt-6 px-6 md:px-8">
                <a href="kelas.php" class="w-40 text-center bg-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-orange-500 transition">
                    Batal
                </a>
                <button type="submit" class="w-40 text-center bg-secondary text-white font-bold py-3 px-6 rounded-lg hover:shadow-lg transition">
                    Daftar
                </button>
            </div>
        </div>
    </form>
</section>

<script>
    var batchData = <?= json_encode($batch_data); ?>;

    document.getElementById('kelas').addEventListener('change', function() {
        var kelasId = this.value;
        var batchDropdown = document.getElementById('batch');
        var hargaInput = document.getElementById('harga');
        
        batchDropdown.innerHTML = '<option value="" disabled selected>Pilih Batch</option>';
        hargaInput.value = ''; // Kosongkan harga saat kelas berubah

        if (batchData[kelasId]) {
            batchData[kelasId].forEach(function(batch) {
                var option = document.createElement('option');
                option.value = batch.idbatch;
                option.textContent = batch.tanggal;
                option.setAttribute('data-harga', batch.harga); // Simpan harga sebagai atribut
                batchDropdown.appendChild(option);
            });
        }
    });

    document.getElementById('batch').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var harga = selectedOption.getAttribute('data-harga');
        document.getElementById('harga').value = harga; // Isi kolom harga
    });
</script>


</body>
</html>
<?php 
$koneksi->close(); 
include 'layout/footer.php';
?>