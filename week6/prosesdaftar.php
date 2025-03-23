<?php
include 'koneksi.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $kelas_id = $_POST['kelas_id']; // ID kelas yang dipilih user
    $batch_id = $_POST['batch_id']; // ID batch yang dipilih user

    // Validasi input agar tidak kosong
    if (empty($email) || empty($kelas_id) || empty($batch_id)) {
        echo "Harap isi semua kolom!";
        exit();
    }

    // Menggunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare("INSERT INTO kelaskeranjang (email, kelas_id, batch_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $email, $kelas_id, $batch_id);

    if ($stmt->execute()) {
        // Redirect ke halaman daftar kelas setelah berhasil mendaftar
        header("Location: kelasterdaftar.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $koneksi->close();
}
?>
