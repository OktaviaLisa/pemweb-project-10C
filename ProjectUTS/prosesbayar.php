<?php
session_start();
include 'koneksi.php';
include 'layout/navbar.php';

// Cek jika data yang dibutuhkan tersedia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['kelas_id'], $_POST['batch_id'], $_POST['harga'])) {
        $_SESSION['idKelas'] = $_POST['kelas_id'];
        $_SESSION['batch_id'] = $_POST['batch_id'];
        $_SESSION['harga'] = $_POST['harga'];
    }
}

// Validasi bahwa semua data penting tersedia
if (!isset($_SESSION['idKelas'], $_SESSION['batch_id'], $_SESSION['harga'], $_SESSION['email'])) {
    echo "<p class='text-center text-red-600'>Data tidak lengkap. Silakan daftar kembali.</p>";
    exit();
}

$idKelas = $_SESSION['idKelas'];
$batch_id = $_SESSION['batch_id'];
$harga = (float) str_replace(['Rp', '.', ','], '', $_SESSION['harga']);
$email = $_SESSION['email'];

// Ambil nama kelas
$sql_kelas = "SELECT namaKelas, jenis FROM kelas WHERE idKelas = '$idKelas'";
$result_kelas = $koneksi->query($sql_kelas);
$kelas = $result_kelas ? $result_kelas->fetch_assoc() : null;
if (!$kelas) {
    $kelas['namaKelas'] = 'Data kelas tidak ditemukan';
}

// Ambil tanggal batch
$sql_batch = "SELECT tanggal FROM batch WHERE idbatch = '$batch_id'";
$result_batch = $koneksi->query($sql_batch);
$batch = $result_batch ? $result_batch->fetch_assoc() : null;
if (!$batch) {
    $batch['tanggal'] = 'Data batch tidak ditemukan';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Konfirmasi Pembayaran</title>
    <style>
        .info-box {
            background: #f3f4f6;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }
        .modal {
            display: none;
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
            width: 90%;
            max-width: 500px;
        }
        .close {
            color: red;
            float: right;
            font-size: 28px;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-secondary">

<section id="prosesbayar" class="pt-36 pb-32">
    <div class="container">
        <div class="max-w-xl mx-auto text-center">
            <h2 class="font-bold text-white text-3xl mb-4 sm:text-4xl">
                Konfirmasi Pembayaran Kelas
            </h2>
        </div>

        <div class="max-w-lg mx-auto bg-white shadow-lg p-6 rounded-lg">
            <div class="info-box">
                <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                <p><strong>Jenis:</strong> <?= htmlspecialchars($kelas['jenis']) ?></p>
                <p><strong>Kelas:</strong> <?= htmlspecialchars($kelas['namaKelas']) ?></p>
                <p><strong>Batch:</strong> <?= htmlspecialchars($batch['tanggal']) ?></p>
                <p><strong>Harga:</strong> Rp <?= number_format($harga, 0, ',', '.') ?></p>
            </div>

            <!-- Form pemilihan metode pembayaran -->
            <form id="paymentForm">
                <div class="mt-4">
                    <label class="font-bold text-secondary">Pilih Metode Pembayaran</label>
                    <select id="bank" name="bank" class="w-full bg-gray-200 p-3 rounded-md focus:outline-none" required>
                        <option value="" disabled selected>Pilih Bank</option>
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="Gopay">Gopay</option>
                        <option value="OVO">OVO</option>
                        <option value="DANA">DANA</option>
                    </select>
                </div>

                <div class="text-center mt-6">
                    <button type="submit" id="submitButton" class="bg-primary text-white py-3 px-6 rounded-lg hover:shadow-lg transition">
                        Bayar Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Modal Konfirmasi -->
<div id="modalKonfirmasi" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalBody">
            <!-- AJAX response akan dimuat di sini -->
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("paymentForm").addEventListener("submit", function(event) {
        event.preventDefault();

        var bank = document.getElementById("bank").value;
        if (!bank) {
            alert("Pilih metode pembayaran terlebih dahulu!");
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "konfirmasibayar.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("modalBody").innerHTML = xhr.responseText;
                showModal();
            }
        };
        xhr.send("bank=" + encodeURIComponent(bank));
    });
});

function showModal() {
    document.getElementById("modalKonfirmasi").style.display = "flex";
}

function closeModal() {
    document.getElementById("modalKonfirmasi").style.display = "none";
}
</script>

</body>
</html>
