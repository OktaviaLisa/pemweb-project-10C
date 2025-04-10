<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namalengkap = trim($_POST['namalengkap']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $konfirpass = $_POST['konfirpass'];

    // Simpan input sebelumnya
    $_SESSION['old_input'] = [
        'namalengkap' => $namalengkap,
        'email' => $email,
        'username' => $username,
    ];

    $error = [];

    if (empty($namalengkap)) $error['namalengkap'] = "Nama lengkap wajib diisi!";
    if (empty($email)) $error['email'] = "Email wajib diisi!";
    if (empty($username)) $error['username'] = "Username wajib diisi!";
    if (empty($password)) $error['password'] = "Password wajib diisi!";
    if (empty($konfirpass)) $error['konfirpass'] = "Konfirmasi password wajib diisi!";

    if (!empty($password) && $password !== $konfirpass) {
        $error['konfirpass'] = "Konfirmasi password tidak cocok!";
    }

    // Cek email & username jika tidak kosong
    if (empty($error['email']) || empty($error['username'])) {
        $stmt = $koneksi->prepare("SELECT email, username FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($used_email, $used_username);

        while ($stmt->fetch()) {
            if ($email === $used_email) $error['email'] = "Email sudah terdaftar!";
            if ($username === $used_username) $error['username'] = "Username sudah terdaftar!";
        }
    }

    if (!empty($error)) {
        $_SESSION['errors'] = $error;
        header("Location: register.php");
        exit();
    }

    // Enkripsi dan simpan
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $koneksi->prepare("INSERT INTO users (namalengkap, email, username, password_hash) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $namalengkap, $email, $username, $password_hash);

    if ($stmt->execute()) {
        unset($_SESSION['old_input']);
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
    } else {
        $_SESSION['error_general'] = "Terjadi kesalahan. Silakan coba lagi.";
        header("Location: register.php");
    }
    exit();
}
?>
