<?php
session_start();
include 'koneksi.php';
include "layout/navbaradmin.php";

// Query untuk mengambil data kelas dan batch
$query = "SELECT kelas.idKelas, kelas.namaKelas, kelas.deskripsi, kelas.gambar, 
                 batch.idbatch, batch.tanggal, batch.harga, batch.status 
          FROM kelas 
          LEFT JOIN batch ON kelas.idKelas = batch.idKelas
          WHERE jenis = 'Bootcamp'";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas & Batch</title>
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

    <div class="pt-36">
        <h2 class="mb-10 text-2xl font-bold text-center text-primary">Daftar Bootcamp & Batch</h2>

        <div class="bg-white shadow-md rounded-lg p-4 overflow-x-auto">
            <!-- Tombol Tambah Kelas -->
            <div class="mb-4 text-right">
                <a href="tambahkelas.php?jenis=Bootcamp" 
                class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition"> + Tambah Kelas
                </a>
            </div>
            <table class="w-full mb-4 border-collapse border border-gray-400 bg-white shadow-md table-auto">
                <thead class="bg-secondary text-white">
                    <tr class="bg-secondary">
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Kelas</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">Batch</th>
                        <th class="border border-gray-300 px-4 py-2">Harga</th>
                        <th class="border border-gray-300 px-4 py-2">Gambar</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2"><?php echo $no++; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['namaKelas']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['deskripsi']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['tanggal']; ?></td>
                            <?php $harga_bersih = str_replace(['Rp', '.', ' '], '', $row['harga']); $harga_format = number_format((int)$harga_bersih, 0, ',', '.');?>
                                <td class="text-lg font-bold text-secondary mt-2">Rp <?php echo $harga_format; ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="img/<?php echo $row['gambar']; ?>" alt="Gambar" class="w-16 h-16 object-cover mx-auto">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <div class="flex justify-center gap-2">
                                <a href="editkelas.php?id=<?php echo $row['idKelas']; ?>" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Edit</a>
                                <a href="hapuskelas.php?id=<?= $row['idKelas'] ?>&jenis=bootcamp" onclick="return confirm('Yakin ingin menghapus kelas ini?');" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"class="text-red-500">Hapus</a>
                                </div>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <?php if ($row['status'] == 'expired'): ?>
                                <span class="text-red-500 font-semibold">Expired</span>
                                <?php else: ?>
                                    <form action="expirebatch.php" method="POST">
                                        <input type="hidden" name="idbatch" value="<?php echo $row['idbatch']; ?>">
                                        <input type="hidden" name="redirect" value="bootcampadmin.php">
                                        <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                        Tandai Expired
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>