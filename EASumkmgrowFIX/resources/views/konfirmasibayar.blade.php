@extends('layout.app')

@section('content')
<section class="pt-36 pb-32">
    <div class="container text-center mx-auto">
        <h2 class="text-3xl font-bold text-secondary mb-4">Konfirmasi Pembayaran</h2>
        <p class="text-lg">Silakan bayar melalui <strong>{{ $metode_pembayaran }}</strong> dengan kode:</p>
        <h3 class="text-2xl font-bold text-primary my-2">{{ $kode_va }}</h3>
        <p class="text-lg">Total: <strong>Rp {{ number_format($harga, 0, ',', '.') }}</strong></p>
        <a href="{{ route('kelasterdaftar') }}">
            <button class="bg-secondary text-white py-3 px-6 rounded-lg mt-4">Selesai</button>
        </a>
    </div>
</section>
@endsection