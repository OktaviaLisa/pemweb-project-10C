<?php
include 'koneksi.php';

// Ambil jenis dari URL
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : 'bootcamp'; // default bootcamp kalau kosong

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
        'bootcamp' => 'bootcampadmin.php',
        'private mentoring' => 'mentoringadmin.php'
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">Tambah Kelas</h2>
        
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-gray-600 font-semibold">Jenis Program</label>
                <input type="text" value="<?php echo htmlspecialchars($jenis); ?>" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <!-- Input Nama Kelas -->
            <div>
                <label class="block text-gray-600 font-semibold">Nama Kelas</label>
                <input type="text" name="namaKelas" placeholder="Masukkan nama kelas" required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Input Deskripsi -->
            <div>
                <label class="block text-gray-600 font-semibold">Deskripsi</label>
                <textarea name="deskripsi" placeholder="Masukkan deskripsi" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Input Gambar -->
            <div>
                <label class="block text-gray-600 font-semibold">Upload Gambar</label>
                <input type="file" name="gambar" required 
                    class="w-full p-3 border border-gray-300 rounded-lg cursor-pointer bg-white file:bg-blue-500 file:text-white file:font-semibold file:px-4 file:py-2 file:rounded-lg file:border-none hover:file:bg-blue-600">
            </div>

            <!-- Input Batch -->
            <div>
                <label class="block text-gray-600 font-semibold">Batch</label>
                <input type="text" name="tanggal" placeholder="Masukkan batch (contoh: Batch 1)" required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Input Harga -->
            <div>
                <label class="block text-gray-600 font-semibold">Harga (Rp)</label>
                <input type="number" name="harga" placeholder="Masukkan harga" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" name="submit" 
                class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                Simpan Kelas
            </button>
        </form>
    </div>

</body>
</html>