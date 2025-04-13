<?php
include 'koneksi.php';

$idbatch = $_POST['idbatch'];
$redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'bootcampadmin.php';

$query = "UPDATE batch SET status='expired' WHERE idbatch='$idbatch'";
$result = $koneksi->query($query);

if ($result) {
    header("Location: $redirect");
} else {
    echo "Gagal mengubah status batch: " . $koneksi->error;
}
?>
