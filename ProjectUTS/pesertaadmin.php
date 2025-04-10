<?php
include 'koneksi.php'; 
include "layout/navbaradmin.php";

// Ambil data user + jumlah pendaftarannya berdasarkan email
$sql = "
    SELECT u.id, u.email, u.username, u.namalengkap, 
           COUNT(k.id) AS jumlah_pendaftaran
    FROM users u
    LEFT JOIN kelaskeranjang k ON u.email = k.email
    GROUP BY u.id, u.email, u.username, u.namalengkap
";

$result = $koneksi->query($sql);
if (!$result) {
    die("Query Error: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peserta</title>
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<section class="pt-24">
    <div class="container">
        <h2 class="text-3xl font-bold text-primary text-center mb-6">Daftar Peserta</h2>
        <div class="bg-white shadow-md rounded-lg p-4 overflow-x-auto">
            <table class="w-full border-collapse border border-gray-400 bg-white shadow-md table-auto">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th class="p-3 border">No.</th>
                        <th class="p-3 border">ID Peserta</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Username</th>
                        <th class="p-3 border">Nama Lengkap</th>
                        <th class="p-3 border">Jumlah Daftar Program</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = $result->fetch_assoc()) : ?>
                        <tr class="text-center">
                            <td class="p-3 border"><?= $no++ ?></td>
                            <td class="p-3 border"><?= htmlspecialchars($row['id']) ?></td>
                            <td class="p-3 border"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="p-3 border"><?= htmlspecialchars($row['username']) ?></td>
                            <td class="p-3 border"><?= htmlspecialchars($row['namalengkap']) ?></td>
                            <td class="p-3 border"><?= $row['jumlah_pendaftaran'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</body>
</html>

<?php $koneksi->close(); ?>
