document.addEventListener("DOMContentLoaded", function () {
    const namaInput = document.getElementById("nama");
    const noTelpInput = document.getElementById("noTelp");
    const alamatInput = document.getElementById("alamat");
    const bidangUsahaInput = document.getElementById("bidangUsaha");
    const jenisKelasInput = document.getElementById("jenisKelas");
    const editIndexInput = document.getElementById("editIndex");
    const dataList = document.getElementById("dataList");

    let dataPendaftar = [];

    window.tambahData = function () {
        let nama = namaInput.value.trim();
        let noTelp = noTelpInput.value.trim();
        let alamat = alamatInput.value.trim();
        let bidangUsaha = bidangUsahaInput.value.trim();
        let jenisKelas = jenisKelasInput.value.trim();

        let isValid = true;

        // Validasi Nama
        let polaNama = /^[a-zA-Z' ]+$/;
        if (!polaNama.test(nama)) {
            alert("Nama hanya boleh berisi huruf dan tanda petik satu (')!");
            namaInput.classList.add("error");
            isValid = false;
        } else {
            namaInput.classList.remove("error");
        }

        // Validasi No. Telepon (hanya angka, panjang 11-12 digit)
        let polaNoTelp = /^[0-9]{11,12}$/;
        if (!polaNoTelp.test(noTelp)) {
            alert("Nomor Telepon harus terdiri dari 11-12 angka dan tidak boleh mengandung huruf!");
            noTelpInput.classList.add("error");
            isValid = false;
        } else {
            noTelpInput.classList.remove("error");
        }

        // Validasi Bidang Usaha (hanya huruf, tidak boleh angka)
        let polaBidangUsaha = /^[a-zA-Z ]+$/;
        if (!polaBidangUsaha.test(bidangUsaha)) {
            alert("Bidang Usaha hanya boleh berisi huruf!");
            bidangUsahaInput.classList.add("error");
            isValid = false;
        } else {
            bidangUsahaInput.classList.remove("error");
        }

        // Validasi Jenis Kelas
        if (jenisKelas === "Pilih Jenis Kelas") {
            alert("Silakan pilih jenis kelas yang valid!");
            jenisKelasInput.classList.add("error");
            isValid = false;
        } else {
            jenisKelasInput.classList.remove("error");
        }

        // Validasi jika ada input yang kosong
        if (!nama || !noTelp || !alamat || !bidangUsaha || jenisKelas === "Pilih Jenis Kelas") {
            alert("Harap isi semua kolom dengan benar!");
            
            if (!nama) namaInput.classList.add("error");
            if (!noTelp) noTelpInput.classList.add("error");
            if (!alamat) alamatInput.classList.add("error");
            if (!bidangUsaha) bidangUsahaInput.classList.add("error");
            if (jenisKelas === "Pilih Jenis Kelas") jenisKelasInput.classList.add("error");

            isValid = false;
        }

        // Jika validasi gagal, hentikan proses penyimpanan data
        if (!isValid) return false;

        // Reset warna border jika input sudah diisi dengan benar
        namaInput.classList.remove("error");
        noTelpInput.classList.remove("error");
        alamatInput.classList.remove("error");
        bidangUsahaInput.classList.remove("error");
        jenisKelasInput.classList.remove("error");

        let pendaftar = { nama, noTelp, alamat, bidangUsaha, jenisKelas };

        let editIndex = editIndexInput.value;
        if (editIndex !== "") {
            dataPendaftar[editIndex] = pendaftar;
        } else {
            dataPendaftar.push(pendaftar);
        }

        renderTable();
        resetForm();
        return false; // Mencegah reload halaman
    };

    function renderTable() {
        dataList.innerHTML = "";
        dataPendaftar.forEach((pendaftar, index) => {
            let row = document.createElement("tr");
            row.innerHTML = `
                <td>${pendaftar.nama}</td>
                <td>${pendaftar.noTelp}</td>
                <td>${pendaftar.alamat}</td>
                <td>${pendaftar.bidangUsaha}</td>
                <td>${pendaftar.jenisKelas}</td>
                <td>
                    <button onclick="editData(${index})">Edit</button>
                    <button onclick="hapusData(${index})">Hapus</button>
                </td>
            `;
            dataList.appendChild(row);
        });
    }

    window.editData = function (index) {
        let pendaftar = dataPendaftar[index];
        namaInput.value = pendaftar.nama;
        noTelpInput.value = pendaftar.noTelp;
        alamatInput.value = pendaftar.alamat;
        bidangUsahaInput.value = pendaftar.bidangUsaha;
        jenisKelasInput.value = pendaftar.jenisKelas;
        editIndexInput.value = index;
    };

    window.hapusData = function (index) {
        dataPendaftar.splice(index, 1);
        renderTable();
    };

    function resetForm() {
        document.getElementById("formPendaftaran").reset();
        editIndexInput.value = "";
        jenisKelasInput.selectedIndex = 0;
    }
});
