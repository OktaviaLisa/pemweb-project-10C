<?php
include 'koneksi.php';

$idbatch = $_POST['idbatch'];

$query = "UPDATE batch SET status='expired' WHERE idbatch='$idbatch'";
$result = $koneksi->query($query);

if ($result) {
    header("Location: kelasadmin.php"); // balik ke halaman admin
} else {
    echo "Gagal mengubah status batch: " . $koneksi->error;
}
?>
