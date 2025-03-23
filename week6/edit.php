<?php
include 'koneksi.php';

// Ambil ID dari POST
$id = $_POST['id'] ?? '';

if (!$id) {
    echo "ID tidak ditemukan!";
    exit;
}

// Ambil data kelas yang sudah didaftarkan berdasarkan ID
$sql = "SELECT k.id, k.email, c.namaKelas, k.kelas_id, k.batch_id, b.harga
        FROM kelaskeranjang k
        JOIN kelas c ON k.kelas_id = c.idKelas
        JOIN batch b ON k.batch_id = b.idbatch
        WHERE k.id = ?";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

// Ambil daftar batch berdasarkan `idKelas`
$sql_batch = "SELECT idbatch, tanggal, harga FROM batch WHERE idKelas = ?";
$stmt_batch = $koneksi->prepare($sql_batch);
$stmt_batch->bind_param("i", $row['kelas_id']);
$stmt_batch->execute();
$result_batch = $stmt_batch->get_result();

// Simpan data batch untuk JavaScript
$batch_data = [];
while ($batch = $result_batch->fetch_assoc()) {
    $batch_data[] = $batch;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Batch Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <section>
        <div class="container">
            <h2 class="text-3xl font-bold text-center mb-6">Edit Batch Kelas</h2>
            <form action="prosesedit.php" method="POST" class="max-w-lg mx-auto bg-white p-6 shadow-lg rounded-md">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input class="w-full bg-gray-200 text-black p-3 rounded-md" type="email" name="email" value="<?= htmlspecialchars($row['email']); ?>" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Kelas:</label>
                    <input class="w-full bg-gray-200 text-black p-3 rounded-md" type="text" name="namaKelas" value="<?= htmlspecialchars($row['namaKelas']); ?>" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Batch:</label>
                    <select id="batch" name="batch_id" class="w-full bg-gray-200 text-black p-3 rounded-md" required>
                        <option value="" disabled selected>Pilih Batch</option>
                        <?php foreach ($batch_data as $batch): ?>
                            <option value="<?= htmlspecialchars($batch['idbatch']); ?>" 
                                data-harga="<?= htmlspecialchars($batch['harga']); ?>"
                                <?= ($batch['idbatch'] == $row['batch_id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($batch['tanggal']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Harga:</label>
                    <input type="text" id="harga" name="harga" class="w-full bg-slate-200 text-black p-3 rounded-md focus:outline-none" readonly />
                </div>

                <div class="flex justify-between">
                    <a href="kelasterdaftar.php" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Batal</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var batchDropdown = document.getElementById("batch");
            var hargaInput = document.getElementById("harga");

            // Set harga awal sesuai dengan batch yang sudah dipilih sebelumnya
            var selectedOption = batchDropdown.options[batchDropdown.selectedIndex];
            if (selectedOption) {
                hargaInput.value = selectedOption.getAttribute("data-harga") || "";
            }

            // Event listener untuk mengubah harga berdasarkan batch yang dipilih
            batchDropdown.addEventListener("change", function () {
                var selectedOption = this.options[this.selectedIndex];
                hargaInput.value = selectedOption.getAttribute("data-harga") || "";
            });
        });
    </script>

</body>
</html>

<?php
$stmt->close();
$stmt_batch->close();
$koneksi->close();
?>
