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
<body class="bg-gray-100 p-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Event</h1>
    <form action="" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md max-w-xl">
        <label class="block mb-2">Nama Event</label>
        <input type="text" name="namaEvent" class="w-full p-2 border rounded mb-4" required>

        <label class="block mb-2">Deskripsi</label>
        <textarea name="deskripsi" class="w-full p-2 border rounded mb-4" required></textarea>

        <label class="block mb-2">Tanggal</label>
        <input type="text" name="tanggal" class="w-full p-2 border rounded mb-4" required>

        <label class="block mb-2">Lokasi</label>
        <input type="text" name="lokasi" class="w-full p-2 border rounded mb-4" required>

        <label class="block mb-2">Gambar</label>
        <input type="file" name="gambar" class="w-full mb-4" required>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah</button>
    </form>
</body>
</html>
