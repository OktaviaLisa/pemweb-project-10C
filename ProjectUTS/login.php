<?php
session_start();
$old = $_SESSION['old_input'] ?? [];
$errors = $_SESSION['errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login - UMKMGrow</title>
</head>
<body class="bg-secondary flex items-center justify-center min-h-screen relative">

    <!-- ✅ ALERT UMUM -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="absolute top-4 left-0 right-0 flex justify-center z-50">
            <div class="bg-green-500 text-white text-center py-2 px-4 rounded-md shadow-md">
                <?= $_SESSION['success']; ?>
            </div>
        </div>
    <?php elseif (!empty($_SESSION['error_general'])): ?>
        <div class="absolute top-4 left-0 right-0 flex justify-center z-50">
            <div class="bg-red-500 text-white text-center py-2 px-4 rounded-md shadow-md">
                <?= $_SESSION['error_general']; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white w-full max-w-2xl h-[500px] rounded-lg shadow-md flex overflow-hidden">

        <!-- Sisi Kiri - Gambar -->
        <div class="w-1/2 text-white p-6 rounded-l-lg bg-cover bg-center"
             style="background-image: url('img/coverlogin.png');">
        </div>

        <!-- Sisi Kanan - Form Login -->
        <div class="w-1/2 p-6 overflow-auto">
            <h2 class="text-xl font-bold text-center text-secondary">Login</h2>
            <form action="ceklogin.php" method="POST" class="mt-4 space-y-1">
                <!-- Username -->
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Username*</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($old['username'] ?? '') ?>" required 
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                        <p class="text-red-500 text-xs mt-1 h-4">
                            <?= $errors['username'] ?? '&nbsp;' ?>
                        </p>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Password*</label>
                    <input type="password" name="password" required 
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm">
                        <p class="text-red-500 text-xs mt-1 h-4 mb-1">
                            <?= $errors['password'] ?? '&nbsp;' ?>
                        </p>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-2 rounded-md text-sm hover:bg-orange-50 transition duration-300">
                    Login
                </button>
            </form>
            <p class="mt-3 text-center text-primary text-xs">
                Belum punya akun? <a href="register.php" class="text-primary font-semibold hover:underline">Daftar Sekarang</a>
            </p>
        </div>
    </div>

<?php
unset($_SESSION['success'], $_SESSION['error_general'], $_SESSION['errors'], $_SESSION['old_input']);
?>
</body>
</html>