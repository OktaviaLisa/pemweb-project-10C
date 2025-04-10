<?php
session_start();
include 'koneksi.php';

// Simpan metode pembayaran dari POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bank'])) {
    $_SESSION['metode_pembayaran'] = $_POST['bank'];
}

// Validasi semua data tersedia
if (!isset($_SESSION['email'], $_SESSION['idKelas'], $_SESSION['batch_id'], $_SESSION['harga'], $_SESSION['metode_pembayaran'])) {
    echo "<p class='text-center text-red-600'>Data tidak lengkap. Silakan daftar ulang.</p>";
    exit();
}

// Ambil data dari session
$email = $_SESSION['email'];
$idKelas = $_SESSION['idKelas'];
$batch_id = $_SESSION['batch_id'];
$metode_pembayaran = $_SESSION['metode_pembayaran'];
$kode_va = strtoupper($metode_pembayaran) . rand(100000, 999999);
$_SESSION['kode_va'] = $kode_va;

$harga = str_replace(['Rp', '.', ','], '', $_SESSION['harga']);
$harga = floatval($harga);

// Simpan ke database
$sql = "INSERT INTO kelaskeranjang (email, kelas_id, batch_id, metode_pembayaran, kode_va) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ssiss", $email, $idKelas, $batch_id, $metode_pembayaran, $kode_va);
$stmt->execute();

// Tampilkan modal jika via AJAX
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    ?>
    <h2 class="font-bold text-secondary text-3xl mb-4">Konfirmasi Pembayaran</h2>
    <p class="text-lg font-semibold">Silakan bayar melalui <strong><?= htmlspecialchars($metode_pembayaran) ?></strong> dengan kode:</p>
    <h3 class="text-2xl font-bold text-primary my-2"><?= htmlspecialchars($kode_va) ?></h3>
    <p class="text-lg">Total: <strong>Rp <?= number_format($harga, 0, ',', '.') ?></strong></p>
    <a href="kelasterdaftar.php">
        <button class="bg-secondary text-white py-3 px-6 rounded-lg mt-4">Selesai</button>
    </a>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembayaran</title>
    <link href="src/output.css" rel="stylesheet">
    <style>
        .modal {
            display: flex;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 350px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal button {
            background-color: #c2410c;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #a8320c;
        }
    </style>
</head>
<body>

<div class="modal" id="modalPopup">
    <div class="modal-content">
        <h2 class="font-bold text-secondary text-3xl mb-4">Konfirmasi Pembayaran</h2>
        <p class="text-lg font-semibold">Silakan bayar melalui <strong><?= htmlspecialchars($metode_pembayaran) ?></strong> dengan kode:</p>
        <h3 class="text-2xl font-bold text-primary my-2"><?= htmlspecialchars($kode_va) ?></h3>
        <p class="text-lg">Total: <strong>Rp <?= number_format($harga, 0, ',', '.') ?></strong></p>
        <a href="kelasterdaftar.php">
            <button>Selesai</button>
        </a>
    </div>
</div>

</body>
</html>
