<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM infoevent WHERE idEvent = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: eventadmin.php");
exit;
?>
