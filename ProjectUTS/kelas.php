<?php 
include "layout/navbar.php"; 
include "koneksi.php";

// Ambil semua data kelas dan batch
$query = "
    SELECT kelas.idKelas, kelas.namaKelas, kelas.deskripsi, kelas.gambar, kelas.jenis,
           batch.tanggal, batch.harga, batch.status
    FROM kelas
    JOIN batch ON kelas.idKelas = batch.idKelas
    ORDER BY kelas.idKelas DESC
";
$result = $koneksi->query($query);

// Ambil data event
$queryEvent = "SELECT * FROM infoevent ORDER BY tanggal DESC";
$resultEvent = $koneksi->query($queryEvent);

// Kelompokkan berdasarkan jenis
$kelas_data = [
    'bootcamp' => [],
    'private mentoring' => []
];

while ($row = $result->fetch_assoc()) {
    $jenis = strtolower($row['jenis']);
    if (isset($kelas_data[$jenis])) {
        $kelas_data[$jenis][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>UMKMGrow - Kelas & Event</title>
</head>

<body class="bg-secondary">
    <div class="max-w-6xl mx-auto px-6 py-10 pt-28">
        
    <?php 
    foreach ($kelas_data as $jenis => $kelas_list) :
    ?>
    <section class="mb-12">
        <h2 class="text-3xl font-bold text-white mb-6 capitalize"><?= $jenis ?></h2>
        
        <?php if (count($kelas_list) > 0) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php foreach ($kelas_list as $kelas) : ?>
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between h-full transition hover:shadow-xl">
                    <img src="img/<?php echo $kelas['gambar']; ?>" alt="<?php echo $kelas['namaKelas']; ?>" class="rounded-lg w-full h-[300px] object-cover mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-secondary"><?php echo $kelas['namaKelas']; ?></h3>
                        <p class="text-gray-700 text-sm min-h-[60px]"><?php echo $kelas['deskripsi']; ?></p>
                        <p class="text-sm font-semibold text-primary mt-2"><?php echo $kelas['tanggal']; ?></p>
                        <?php 
                        $harga_bersih = str_replace(['Rp', '.', ' '], '', $kelas['harga']); 
                        $harga_format = number_format((int)$harga_bersih, 0, ',', '.');
                        ?>
                        <p class="text-2xl font-bold text-secondary mt-2">Rp <?php echo $harga_format; ?></p>
                    </div>
                    <?php if (strtolower($kelas['status']) === 'expired') : ?>
                        <span class="mt-4 inline-block bg-gray-400 text-white font-bold text-center py-2 px-4 rounded-lg cursor-not-allowed opacity-70">
                            Pendaftaran Ditutup
                        </span>
                    <?php else : ?>
                        <a href="daftar.php?idKelas=<?= $kelas['idKelas']; ?>&jenis=<?= urlencode($kelas['jenis']); ?>&namaKelas=<?= urlencode($kelas['namaKelas']); ?>&harga=<?= $kelas['harga']; ?>" 
                            class="mt-4 inline-block bg-primary text-white font-bold text-center py-2 px-4 rounded-lg hover:bg-orange-500 transition">
                            Daftar Sekarang
                        </a>

                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-white text-lg italic">Program belum tersedia untuk saat ini.</p>
        <?php endif; ?>
    </section>
    <?php 
    endforeach; 
    ?>

    <!-- SECTION: Event -->
    <section class="mb-12">
            <h2 class="text-3xl font-bold text-white mb-6">Informasi Event</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                <?php while ($event = $resultEvent->fetch_assoc()) { ?>
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between h-full transition hover:shadow-xl">
                        <img src="img/<?php echo $event['gambar']; ?>" alt="<?php echo $event['namaEvent']; ?>" class="rounded-lg w-full h-[250px] object-cover mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-secondary"><?php echo $event['namaEvent']; ?></h3>
                            <p class="text-gray-700 text-sm min-h-[60px]"><?php echo substr($event['deskripsi'], 0, 100); ?>...</p>
                            <p class="text-sm font-semibold text-primary mt-2"><?php echo $event['tanggal']; ?> | <?php echo $event['lokasi']; ?></p>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </section>


    </div>

    <?php include "layout/footer.php" ?>
</body>
</html>