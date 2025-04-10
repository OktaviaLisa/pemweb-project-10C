<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $idKelas = $_GET['id'];

    // Ambil jenis dulu sebelum menghapus
    $jenisQuery = "SELECT jenis FROM kelas WHERE idKelas = ?";
    $stmtJenis = $koneksi->prepare($jenisQuery);
    $stmtJenis->bind_param("i", $idKelas);
    $stmtJenis->execute();
    $result = $stmtJenis->get_result();
    $row = $result->fetch_assoc();
    $stmtJenis->close();

    // Jika berhasil ambil jenis
    if ($row && isset($row['jenis'])) {
        $jenis = strtolower($row['jenis']);

        // Hapus data batch
        $queryBatch = "DELETE FROM batch WHERE idKelas = ?";
        $stmtBatch = $koneksi->prepare($queryBatch);
        $stmtBatch->bind_param("i", $idKelas);
        $stmtBatch->execute();
        $stmtBatch->close();

        // Hapus data kelas
        $queryKelas = "DELETE FROM kelas WHERE idKelas = ?";
        $stmtKelas = $koneksi->prepare($queryKelas);
        $stmtKelas->bind_param("i", $idKelas);
        $stmtKelas->execute();
        $stmtKelas->close();

        // Redirect sesuai jenis
        if ($jenis == 'bootcamp') {
            header("Location: bootcampadmin.php");
        } elseif ($jenis == 'private mentoring') {
            header("Location: mentoringadmin.php");
        } else {
            header("Location: indexAdmin.php"); // fallback
        }

        exit();
    } else {
        echo "Jenis tidak ditemukan!";
    }
} else {
    echo "ID tidak ditemukan!";
}
?>