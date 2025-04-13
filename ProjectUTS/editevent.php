<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-10 bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold text-primary mb-6 text-center">Edit Event</h2>

        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <!-- Nama Event -->
            <div>
                <label class="block text-secondary font-semibold">Nama Event</label>
                <input type="text" name="namaEvent" value="<?= $data['namaEvent']; ?>" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-secondary font-semibold">Deskripsi</label>
                <textarea name="deskripsi" required rows="4"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"><?= $data['deskripsi']; ?></textarea>
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block text-secondary font-semibold">Tanggal</label>
                <input type="text" name="tanggal" value="<?= $data['tanggal']; ?>" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block text-secondary font-semibold">Lokasi</label>
                <input type="text" name="lokasi" value="<?= $data['lokasi']; ?>" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
            </div>

            <!-- Gambar -->
            <div>
                <label class="block text-secondary font-semibold">Gambar Saat Ini</label>
                <img src="img/<?= $data['gambar']; ?>" alt="Gambar Event" class="w-32 h-32 object-cover mb-2 rounded-md">
                <input type="file" name="gambar"
                    class="w-full p-3 border border-gray-300 rounded-lg cursor-pointer bg-white file:bg-secondary file:text-white file:font-semibold file:px-4 file:py-2 file:rounded-lg file:border-none hover:opacity-90 transition">
            </div>

            <!-- Tombol -->
            <div class="flex gap-10">
                <a href="eventadmin.php"
                    class="w-full text-center bg-primary text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                    Batal
                </a>
                <button type="submit" name="submit"
                    class="w-full bg-secondary text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
