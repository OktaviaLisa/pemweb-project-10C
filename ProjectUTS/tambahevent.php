<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaEvent = $_POST['namaEvent'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    $upload = move_uploaded_file($tmp, "img/" . $gambar);

    if ($upload) {
        $query = "INSERT INTO infoevent (namaEvent, deskripsi, tanggal, lokasi, gambar) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("sssss", $namaEvent, $deskripsi, $tanggal, $lokasi, $gambar);
        $stmt->execute();
        header("Location: eventadmin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Event</title>
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-10 bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold text-primary mb-6 text-center">Tambah Event</h2>

        <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
            <!-- Input Nama Event -->
            <div>
                <label class="block text-secondary font-semibold">Nama Event</label>
                <input type="text" name="namaEvent" required 
                    placeholder="Masukkan nama event"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
            </div>

            <!-- Input Deskripsi -->
            <div>
                <label class="block text-secondary font-semibold">Deskripsi</label>
                <textarea name="deskripsi" required
                    placeholder="Masukkan deskripsi"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"></textarea>
            </div>

            <!-- Input Tanggal -->
            <div>
                <label class="block text-secondary font-semibold">Tanggal</label>
                <input type="text" name="tanggal" required 
                    placeholder="Masukkan tanggal event"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
            </div>

            <!-- Input Lokasi -->
            <div>
                <label class="block text-secondary font-semibold">Lokasi</label>
                <input type="text" name="lokasi" required 
                    placeholder="Masukkan lokasi"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
            </div>

            <!-- Upload Gambar -->
            <div>
                <label class="block text-secondary font-semibold">Upload Gambar</label>
                <input type="file" name="gambar" required 
                    class="w-full p-3 border border-gray-300 rounded-lg cursor-pointer bg-white file:bg-secondary file:text-white file:font-semibold file:px-4 file:py-2 file:rounded-lg file:border-none hover:opacity-90 transition">
            </div>

            <!-- Tombol -->
            <div class="flex gap-10">
                <!-- Tombol Batal -->
                <a href="eventadmin.php"
                   class="w-full text-center bg-primary text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                   Batal
                </a>

                <!-- Tombol Simpan -->
                <button type="submit" 
                    class="w-full bg-secondary text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                    Tambah Event
                </button>
            </div>
        </form>
    </div>

</body>
</html>
