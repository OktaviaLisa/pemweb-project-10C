<?php
include 'koneksi.php'; // Koneksi ke database

// Pastikan ID yang akan dihapus tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan idKeranjang
    $sql = "DELETE FROM kelaskeranjang WHERE id = ?";

    // Persiapkan dan jalankan query
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika berhasil, redirect ke halaman daftar
        header("Location: kelasterdaftar.php"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        echo "Gagal menghapus data! Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID tidak ditemukan!";
}

$koneksi->close();
?>