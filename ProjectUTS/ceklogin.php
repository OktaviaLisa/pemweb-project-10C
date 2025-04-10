<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Simpan input lama ke session
    $_SESSION['old_input'] = [
        'username' => $username
    ];

    $errors = [];

    // Pengecekan khusus untuk admin
    if ($username === "admin" && $password === "admin123") {
        $_SESSION["login"] = true;
        $_SESSION["username"] = "admin";
        header("Location: indexAdmin.php");
        exit();
    }

    // Validasi input kosong (opsional tambahan)
    if (empty($username)) {
        $errors['username'] = "Username wajib diisi.";
    }
    if (empty($password)) {
        $errors['password'] = "Password wajib diisi.";
    }

    // Jika tidak ada error validasi awal
    if (empty($errors)) {
        $stmt = $koneksi->prepare("SELECT id, email, password_hash FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $email, $password_hash);
            $stmt->fetch();
    
            if (password_verify($password, $password_hash)) {
                $_SESSION["login"] = true;
                $_SESSION["user_id"] = $user_id;
                $_SESSION["username"] = $username;
                $_SESSION["email"] = $email; // ✅ Sekarang email valid
                unset($_SESSION['old_input'], $_SESSION['errors']);
                header("Location: index.php");
                exit();
            } else {
                $errors['password'] = "Password salah!";
            }
        } else {
            $errors['username'] = "Username tidak ditemukan!";
        }
    }
    

    $_SESSION['errors'] = $errors;
    header("Location: login.php");
    exit();
}
