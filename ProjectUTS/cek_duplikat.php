<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['email' => false, 'username' => false];

    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';

    if (!empty($email)) {
        $stmt = $koneksi->prepare("SELECT 1 FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $response['email'] = $stmt->num_rows > 0;
    }

    if (!empty($username)) {
        $stmt = $koneksi->prepare("SELECT 1 FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $response['username'] = $stmt->num_rows > 0;
    }

    echo json_encode($response);
}
?>
