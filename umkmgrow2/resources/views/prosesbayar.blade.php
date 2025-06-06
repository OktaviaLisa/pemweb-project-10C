@extends('layout.app')
@include('components.navbar')

@section('content')
<section id="prosesbayar" class="pt-36 pb-32">
    <div class="container">
        <div class="max-w-xl mx-auto text-center">
            <h2 class="font-bold text-secondary text-3xl mb-4 sm:text-4xl">
                Konfirmasi Pembayaran Kelas
            </h2>
        </div>

        <div class="max-w-lg mx-auto bg-white shadow-lg p-6 rounded-lg">
            <div class="info-box bg-gray-100 p-4 rounded mb-6">
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Jenis:</strong> {{ $kelas->jenis }}</p>
                <p><strong>Kelas:</strong> {{ $kelas->namaKelas }}</p>
                <p><strong>Batch:</strong> {{ $batch->tanggal }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($harga, 0, ',', '.') }}</p>
            </div>

            <form id="paymentForm" method="POST" action="{{ route('konfirmasibayar') }}">
                @csrf
                <div class="mt-4">
                    <label class="font-bold text-secondary">Pilih Metode Pembayaran</label>
                    <select id="metode_pembayaran" name="metode_pembayaran" class="w-full bg-gray-200 p-3 rounded-md focus:outline-none" required>
                        <option value="" disabled selected>Pilih Bank</option>
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="Gopay">Gopay</option>
                        <option value="OVO">OVO</option>
                        <option value="DANA">DANA</option>
                    </select>
                </div>

                <div class="text-center mt-6">
                    <button type="submit" id="submitButton" class="bg-primary text-white py-3 px-6 rounded-lg hover:shadow-lg transition">
                        Bayar Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection