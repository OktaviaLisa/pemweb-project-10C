// navbar fixed 
window.onscroll = function() {
    const header = document.querySelector('header');
    const fixedNav = header.offsetTop;

    if(window.pageYOffset > fixedNav) {
        header.classList.add('navbar-fixed');
    } else {
        header.classList.remove('navbar-fixed');
    }
};

//hamburger

const hamburger = document.querySelector('#hamburger');
const navMenu = document.querySelector('#nav-menu');

hamburger.addEventListener('click', function () {
    hamburger.classList.toggle( 'hamburger-active');
    navMenu.classList.toggle('flex');
    navMenu.classList.toggle('hidden');
    navMenu.classList.toggle('active');


});

document.addEventListener("DOMContentLoaded", function () {
    const jprogram = document.getElementById("jprogram");
    const jkelas = document.getElementById("jkelas");
    const batch = document.getElementById("batch");

    const kelasOptions = {
        "bootcamp": [
            { value: "digitalMarketing", text: "Digital Marketing" },
            { value: "manajemenKeuangan", text: "Manajemen Keuangan" },
            { value: "brandingDesain", text: "Branding & Desain Produk" }
        ],
        "privateMentoring": [
            { value: "intensifDigitalMarketing", text: "Intensif Digital Marketing" },
            { value: "intensifManajemenKeuangan", text: "Intensif Manajemen Keuangan" },
            { value: "intensifBrandingDesain", text: "Intensif Branding & Desain Produk" },
            { value: "intensifUMKMGrow", text: "Intensif UMKMGrow" }
        ]
    };

    const batchOptions = {
        "digitalMarketing": ["Batch 1: 10 Maret 2025", "Batch 2: 20 April 2025"],
        "manajemenKeuangan": ["Batch 1: 15 Maret 2025", "Batch 2: 25 April 2025"],
        "brandingDesain": ["Batch 1: 5 April 2025", "Batch 2: 10 Mei 2025"],
        "intensifDigitalMarketing": ["Batch 1: 10 Januari 2025-8 Maret 2025", "Batch 2: 23 Maret 2025-18 Mei 2025"],
        "intensifManajemenKeuangan": ["Batch 1: 3 Januari 2025-12 Maret 2025", "Batch 2: 29 Maret 2025-23 Mei 2025"],
        "intensifBrandingDesain": ["Batch 1: 11 Januari 2025-20 Maret 2025", "Batch 2: 5 April 2025-7 Juni 2025"],
        "intensifUMKMGrow": ["Batch 1: 23 Juli 2025-20 November 2025"]
    };

    jprogram.addEventListener("change", function () {
        jkelas.innerHTML = "<option value=''>Pilih Jenis Kelas</option>";
        batch.innerHTML = "<option value=''>Pilih Batch</option>";

        const selectedProgram = jprogram.value;
        if (kelasOptions[selectedProgram]) {
            kelasOptions[selectedProgram].forEach(kelas => {
                const option = document.createElement("option");
                option.value = kelas.value;
                option.textContent = kelas.text;
                jkelas.appendChild(option);
            });
        }
    });

    jkelas.addEventListener("change", function () {
        batch.innerHTML = "<option value=''>Pilih Batch</option>";

        const selectedKelas = jkelas.value;
        if (batchOptions[selectedKelas]) {
            batchOptions[selectedKelas].forEach(b => {
                const option = document.createElement("option");
                option.textContent = b;
                batch.appendChild(option);
            });
        }
    });
});

// Form Validation
const form = document.querySelector("form");

// Fungsi untuk menampilkan error di bawah input/select
function showError(input, message) {
    let errorText = input.nextElementSibling;
    if (!errorText || !errorText.classList.contains("error-text")) {
        errorText = document.createElement("small");
        errorText.classList.add("error-text");
        errorText.style.color = "red";
        input.parentNode.appendChild(errorText);
    }
    errorText.textContent = message;
    input.classList.add("border-red-500");
}

// Fungsi untuk menghapus error jika valid
function clearError(input) {
    let errorText = input.nextElementSibling;
    if (errorText && errorText.classList.contains("error-text")) {
        errorText.remove();
    }
    input.classList.remove("border-red-500");
}

// Fungsi validasi untuk input & select
function validateInput(input) {
    let isValid = true;

    if (input.tagName === "INPUT") {
        if (input.id === "name") {
            const nameRegex = /^[a-zA-Z'\s]+$/;
            if (!input.value || !nameRegex.test(input.value)) {
                showError(input, "Nama hanya boleh berisi huruf dan spasi");
                isValid = false;
            } else {
                clearError(input);
            }
        }

        if (input.id === "email") {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!input.value || !emailRegex.test(input.value)) {
                showError(input, "Format email salah, contoh: user@email.com");
                isValid = false;
            } else {
                clearError(input);
            }
        }

        if (input.id === "nohp") {
            if (!input.value || input.value.length < 11 || input.value.length > 12) {
                showError(input, "Nomor HP harus 11-12 digit");
                isValid = false;
            } else {
                clearError(input);
            }
        }
    }

    if (input.tagName === "SELECT") {
        if (!input.value) {
            showError(input, "Silakan pilih salah satu opsi");
            isValid = false;
        } else {
            clearError(input);
        }
    }

    return isValid;
}

// Validasi langsung saat mengetik/memilih opsi
document.querySelectorAll("input, select").forEach((input) => {
    input.addEventListener("input", function () {
        validateInput(this);
    });

    input.addEventListener("change", function () {
        validateInput(this);
    });
});

// Validasi saat submit
form.addEventListener("submit", function (e) {
    e.preventDefault();
    let isValid = true;

    document.querySelectorAll("input, select").forEach((input) => {
        if (!validateInput(input)) {
            isValid = false;
        }
    });

    if (!isValid) {
        alert("Harap isi semua field dengan benar!");
    } else {
        alert("Anda berhasil daftar! Selamat mengikuti kelas bersama kami🧡");
        form.submit();
    }
});
