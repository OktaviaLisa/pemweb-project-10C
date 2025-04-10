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
    <title>Register - UMKMGrow</title>
</head>

<body class="bg-secondary flex items-center justify-center min-h-screen relative">
    
    <?php if (!empty($_SESSION['error_general'])): ?>
        <div class="absolute top-4 left-0 right-0 flex justify-center z-50">
            <div class="bg-red-500 text-white text-center py-2 px-4 rounded-md shadow-md">
                <?= $_SESSION['error_general']; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white w-full max-w-3xl h-[500px] rounded-lg shadow-md flex overflow-hidden">
        
        <!-- Gambar -->
        <div class="w-1/2 text-white p-6 rounded-l-lg bg-cover bg-center"
             style="background-image: url('img/registercover.jpg');">
        </div>

        <!-- Form -->
        <div class="w-1/2 p-6 overflow-auto">
            <h2 class="text-xl font-bold text-center text-secondary">Daftar</h2>
            <form action="prosesregistrasi.php" method="POST" class="mt-4 space-y-0.75">

                <!-- Email -->
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Email*</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm <?= !empty($errors['email']) ? 'border-red-500' : '' ?>">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] error-msg">
                        <?= $errors['email'] ?? '&nbsp;' ?>
                    </p>
                </div>

                <!-- Username -->
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Username*</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($old['username'] ?? '') ?>" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm <?= !empty($errors['username']) ? 'border-red-500' : '' ?>">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] error-msg">
                        <?= $errors['username'] ?? '&nbsp;' ?>
                    </p>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Nama Lengkap*</label>
                    <input type="text" name="namalengkap" value="<?= htmlspecialchars($old['namalengkap'] ?? '') ?>" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm <?= !empty($errors['namalengkap']) ? 'border-red-500' : '' ?>">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] error-msg">
                        <?= $errors['namalengkap'] ?? '&nbsp;' ?>
                    </p>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Password*</label>
                    <input type="password" name="password" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm <?= !empty($errors['password']) ? 'border-red-500' : '' ?>">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] error-msg">
                        <?= $errors['password'] ?? '&nbsp;' ?>
                    </p>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-secondary text-sm font-medium mb-1">Konfirmasi Password*</label>
                    <input type="password" name="konfirpass" required
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm <?= !empty($errors['konfirpass']) ? 'border-red-500' : '' ?>">
                    <p class="text-red-500 text-xs mt-1 min-h-[1rem] password-error-msg">
                        <?= $errors['konfirpass'] ?? '&nbsp;' ?>
                    </p>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-2 mt-2 rounded-md text-sm hover:bg-orange-500 transition duration-300">
                    Daftar
                </button>
            </form>

            <p class="mt-3 text-center text-primary text-xs w-full">
                Sudah punya akun? <a href="login.php" class="text-primary font-semibold hover:underline">Masuk</a>
            </p>
        </div>
    </div>

    <?php
    unset($_SESSION['errors'], $_SESSION['old_input'], $_SESSION['error_general']);
    ?>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const emailInput = document.querySelector("input[name='email']");
        const usernameInput = document.querySelector("input[name='username']");

        function checkDuplicate(field, value) {
            const formData = new FormData();
            formData.append(field, value);

            fetch("cek_duplikat.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data[field]) {
                    setError(field, ${field.charAt(0).toUpperCase() + field.slice(1)} sudah digunakan!);
                } else {
                    clearError(field);
                }
            });
        }

        function setError(field, message) {
            const input = document.querySelector(input[name='${field}']);
            input.classList.add("border-red-500");

            let errorMsg = input.parentNode.querySelector(".error-msg");
            if (!errorMsg) {
                errorMsg = document.createElement("p");
                errorMsg.className = "text-red-500 text-xs mt-1 min-h-[1rem] error-msg";
                input.parentNode.appendChild(errorMsg);
            }
            errorMsg.textContent = message;
        }

        function clearError(field) {
            const input = document.querySelector(input[name='${field}']);
            input.classList.remove("border-red-500");

            const errorMsg = input.parentNode.querySelector(".error-msg");
            if (errorMsg) errorMsg.innerHTML = "&nbsp;";
        }

        emailInput.addEventListener("blur", () => checkDuplicate("email", emailInput.value));
        usernameInput.addEventListener("blur", () => checkDuplicate("username", usernameInput.value));

        const password = document.querySelector('input[name="password"]');
        const konfirpass = document.querySelector('input[name="konfirpass"]');

        function checkPasswordMatch() {
            const passVal = password.value;
            const konfirVal = konfirpass.value;

            const msgContainer = konfirpass.parentElement.querySelector('.password-error-msg');

            if (konfirVal && passVal !== konfirVal) {
                konfirpass.classList.add('border-red-500');
                if (msgContainer) {
                    msgContainer.textContent = "Konfirmasi password tidak cocok!";
                }
            } else {
                konfirpass.classList.remove('border-red-500');
                if (msgContainer) {
                    msgContainer.innerHTML = '&nbsp;';
                }
            }
        }

        password.addEventListener('input', checkPasswordMatch);
        konfirpass.addEventListener('input', checkPasswordMatch);
    });
    </script>

</body>
</html>