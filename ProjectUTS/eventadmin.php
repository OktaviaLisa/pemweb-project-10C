<?php
session_start();
include 'koneksi.php';
include "layout/navbaradmin.php";

// Ambil semua data event
$query = "SELECT * FROM infoevent ORDER BY tanggal DESC";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Data Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="pt-36">
        <h2 class="mb-10 text-2xl font-bold text-center text-primary">Daftar Event</h2>

        <div class="bg-white shadow-md rounded-lg p-4 overflow-x-auto">
            <!-- Tombol Tambah Event -->
            <div class="mb-4 text-right">
                <a href="tambahevent.php" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition">+ Tambah Event</a>
            </div>
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-secondary text-white">
                    <tr class="bg-secondary">
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama Event</th>
                        <th class="border px-4 py-2">Deskripsi</th>
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Lokasi</th>
                        <th class="border px-4 py-2">Gambar</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while($row = $result->fetch_assoc()) { ?>
                    <tr class="text-center">
                        <td class="border px-4 py-2"><?php echo $no++; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['namaEvent']; ?></td>
                        <td class="border px-4 py-2"><?php echo substr($row['deskripsi'], 0, 50); ?>...</td>
                        <td class="border px-4 py-2"><?php echo $row['tanggal']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['lokasi']; ?></td>
                        <td class="border px-4 py-2">
                            <img src="img/<?php echo $row['gambar']; ?>" alt="Gambar Event" class="w-16 h-16 object-cover mx-auto">
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex justify-center gap-2">
                                <a href="editevent.php?id=<?php echo $row['idEvent']; ?>" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                                <a href="hapusevent.php?id=<?php echo $row['idEvent']; ?>" onclick="return confirm('Yakin ingin menghapus event ini?');" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            
        </div>
    </div>
</body>
</html>
