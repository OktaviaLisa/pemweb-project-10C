<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $idKelas = $_GET['id'];

    $query = "SELECT kelas.*, batch.tanggal, batch.harga FROM kelas 
              JOIN batch ON kelas.idKelas = batch.idKelas 
              WHERE kelas.idKelas = '$idKelas'";
    $result = $koneksi->query($query);
    $data = $result->fetch_assoc();

    $jenis = $data['jenis'];
}

if (isset($_POST['submit'])) {
    $namaKelas = $_POST['namaKelas'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $harga = $_POST['harga'];
    $jenis = $_POST['jenis']; // diambil dari input hidden

    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "img/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

        $queryKelas = "UPDATE kelas SET namaKelas='$namaKelas', deskripsi='$deskripsi', gambar='$gambar' 
                       WHERE idKelas='$idKelas'";
    } else {
        $queryKelas = "UPDATE kelas SET namaKelas='$namaKelas', deskripsi='$deskripsi' 
                       WHERE idKelas='$idKelas'";
    }

    $koneksi->query($queryKelas);

    $queryBatch = "UPDATE batch SET tanggal='$tanggal', harga='$harga' WHERE idKelas='$idKelas'";
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
    <title>Edit Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">Edit Kelas</h2>
        
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="jenis" value="<?= htmlspecialchars($jenis); ?>">

            <div>
                <label class="block text-gray-600 font-semibold">Jenis Program</label>
                <input type="text" value="<?= htmlspecialchars($jenis); ?>" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Nama Kelas</label>
                <input type="text" name="namaKelas" value="<?= $data['namaKelas']; ?>" required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Deskripsi</label>
                <textarea name="deskripsi" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= $data['deskripsi']; ?></textarea>
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Gambar Saat Ini</label>
                <img src="img/<?= $data['gambar']; ?>" alt="Gambar Kelas" class="w-32 h-32 object-cover mb-2">
                <input type="file" name="gambar" 
                    class="w-full p-3 border border-gray-300 rounded-lg cursor-pointer bg-white file:bg-blue-500 file:text-white file:font-semibold file:px-4 file:py-2 file:rounded-lg file:border-none hover:file:bg-blue-600">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Tanggal Batch</label>
                <input type="text" name="tanggal" value="<?= $data['tanggal']; ?>" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Harga (Rp)</label>
                <input type="number" name="harga" value="<?= $data['harga']; ?>" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" name="submit" 
                class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                Simpan Perubahan
            </button>
        </form>
    </div>

</body>
</html>