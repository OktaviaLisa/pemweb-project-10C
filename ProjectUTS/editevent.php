<?php
include 'koneksi.php';

// Ambil data event berdasarkan ID
if (isset($_GET['id'])) {
    $idEvent = $_GET['id'];
    $query = "SELECT * FROM infoevent WHERE idEvent = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $idEvent);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}

// Proses saat form disubmit
if (isset($_POST['submit'])) {
    $namaEvent = $_POST['namaEvent'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];

    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "img/" . $gambar);

        $query = "UPDATE infoevent SET namaEvent=?, deskripsi=?, tanggal=?, lokasi=?, gambar=? WHERE idEvent=?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("sssssi", $namaEvent, $deskripsi, $tanggal, $lokasi, $gambar, $idEvent);
    } else {
        $query = "UPDATE infoevent SET namaEvent=?, deskripsi=?, tanggal=?, lokasi=? WHERE idEvent=?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssssi", $namaEvent, $deskripsi, $tanggal, $lokasi, $idEvent);
    }

    $stmt->execute();
    header("Location: eventadmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">Edit Event</h2>
        
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-gray-600 font-semibold">Nama Event</label>
                <input type="text" name="namaEvent" value="<?= $data['namaEvent']; ?>" required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Deskripsi</label>
                <textarea name="deskripsi" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= $data['deskripsi']; ?></textarea>
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Tanggal</label>
                <input type="text" name="tanggal" value="<?= $data['tanggal']; ?>" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Lokasi</label>
                <input type="text" name="lokasi" value="<?= $data['lokasi']; ?>" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Gambar Saat Ini</label>
                <img src="img/<?= $data['gambar']; ?>" alt="Gambar Event" class="w-32 h-32 object-cover mb-2">
                <input type="file" name="gambar" 
                    class="w-full p-3 border border-gray-300 rounded-lg cursor-pointer bg-white file:bg-blue-500 file:text-white file:font-semibold file:px-4 file:py-2 file:rounded-lg file:border-none hover:file:bg-blue-600">
            </div>

            <button type="submit" name="submit" 
                class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                Simpan Perubahan
            </button>
        </form>
    </div>

</body>
</html>
