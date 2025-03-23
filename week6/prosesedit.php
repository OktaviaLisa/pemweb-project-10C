<?php
include 'koneksi.php';

// Pastikan request berasal dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? '';
    $batch_id = $_POST['batch_id'] ?? '';

    if (!$id || !$batch_id) {
        echo "Data tidak lengkap!";
        exit;
    }

    // Update data batch di database
    $sql = "UPDATE kelaskeranjang SET batch_id = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ii", $batch_id, $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Data berhasil diperbarui!');
                window.location.href = 'kelasterdaftar.php';
              </script>";
        exit; // Pastikan tidak ada kode yang dieksekusi setelahnya
    } else {
        echo "<script>alert('Gagal memperbarui data!'); history.back();</script>";
    }    

    $stmt->close();
    $koneksi->close();
} else {
    echo "Akses ditolak!";
}
?>
