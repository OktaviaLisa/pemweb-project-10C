<?php
include 'koneksi.php';

// Ambil jenis dari URL
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : 'Bootcamp'; // default bootcamp kalau kosong

if (isset($_POST['submit'])) {
    $namaKelas = $_POST['namaKelas'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $harga = $_POST['harga'];
    
    // Upload Gambar
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "img/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
    
    // Insert ke tabel kelas + jenis
    $queryKelas = "INSERT INTO kelas (namaKelas, deskripsi, gambar, jenis) 
                   VALUES ('$namaKelas', '$deskripsi', '$gambar', '$jenis')";
    $koneksi->query($queryKelas);
    
    // Ambil idKelas yang baru saja dibuat
    $idKelas = $koneksi->insert_id;
    
    // Insert ke tabel batch
    $queryBatch = "INSERT INTO batch (idKelas, tanggal, harga, status) 
                   VALUES ('$idKelas', '$tanggal', '$harga', 'aktif')";
    $koneksi->query($queryBatch);

    // Redirect map berdasarkan jenis
    $redirectMap = [
        'Bootcamp' => 'bootcampadmin.php',
        'Private Mentoring' => 'mentoringadmin.php'
    ];

    if (isset($redirectMap[$jenis])) {
        header("Location: " . $redirectMap[$jenis]);
        exit();
    } else {
        echo "Jenis tidak dikenali: $jenis";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-10 bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold text-primary mb-6 text-center">Tambah Kelas</h2>
        
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-secondary font-semibold">Jenis Program</label>
                <input type="text" value="<?php echo htmlspecialchars($jenis); ?>" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <!-- Input Nama Kelas -->
            <div>
                <label class="block text-secondary font-semibold">Nama Kelas</label>
                <input type="text" name="namaKelas" placeholder="Masukkan nama kelas" required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
            </div>

            <!-- Input Deskripsi -->
            <div>
                <label class="block text-secondary font-semibold">Deskripsi</label>
                <textarea name="deskripsi" placeholder="Masukkan deskripsi" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"></textarea>
            </div>

            <!-- Input Gambar -->
            <div>
                <label class="block text-secondary font-semibold">Upload Gambar</label>
                <input type="file" name="gambar" required 
                    class="w-full p-3 border border-gray-300 rounded-lg cursor-pointer bg-white file:bg-secondary file:text-white file:font-semibold file:px-4 file:py-2 file:rounded-lg file:border-none hover:opacity-90 transition">
            </div>

            <!-- Input Batch -->
            <div>
                <label class="block text-secondary font-semibold">Batch</label>
                <input type="text" name="tanggal" placeholder="Masukkan batch (contoh: Batch 1: 5 April 2025-7 Mei 2025)" required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
            </div>

            <!-- Input Harga -->
            <div>
                <label class="block text-secondary font-semibold">Harga (Rp)</label>
                <input type="number" name="harga" placeholder="Masukkan harga" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
            </div>

            <div class="flex gap-10">
                <!-- Tombol Batal -->
                <a href="<?php echo ($jenis === 'Private Mentoring') ? 'mentoringadmin.php' : 'bootcampadmin.php'; ?>" 
                    class="w-full text-center bg-primary text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                    Batal
                </a>

                <!-- Tombol Simpan -->
                <button type="submit" name="submit" 
                    class="w-full bg-secondary text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                    Simpan Kelas
                </button>
            </div>
        </form>
    </div>

</body>
</html>

