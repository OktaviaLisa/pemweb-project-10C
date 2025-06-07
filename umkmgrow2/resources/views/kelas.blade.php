@extends('layout.app') {{-- Ini WAJIB ditaruh di paling atas --}}

@include('components.navbar')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10 pt-28">

    @foreach ($kelas_data as $jenis => $kelas_list)
    <section class="mb-12">
        <h2 class="text-3xl font-bold text-white mb-6 capitalize">{{ $jenis }}</h2>

        @if (count($kelas_list) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($kelas_list as $kelas)
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between h-full transition hover:shadow-xl">
                <img src="{{ asset('img/' . $kelas->gambar) }}" alt="{{ $kelas->namaKelas }}" class="rounded-lg w-full h-[300px] object-cover mb-4">
                <div>
                    <h3 class="text-xl font-bold text-secondary">{{ $kelas->namaKelas }}</h3>
                    <p class="text-gray-700 text-sm min-h-[60px]">{{ $kelas->deskripsi }}</p>
                    <p class="text-sm font-semibold text-primary mt-2">
                        @if ($kelas->batch && $kelas->batch->tanggal_mulai && $kelas->batch->tanggal_selesai)
                            {{ \Carbon\Carbon::parse($kelas->batch->tanggal_mulai)->format('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($kelas->batch->tanggal_selesai)->format('d M Y') }}
                        @else
                            <span class="text-red-500 text-sm">Tanggal belum tersedia</span>
                        @endif
                    </p>
                    <p class="text-2xl font-bold text-secondary mt-2">
                        @if ($kelas->batch && $kelas->batch->harga !== null)
                            Rp {{ number_format($kelas->batch->harga, 0, ',', '.') }}
                        @else
                            <span class="text-red-500 text-sm">Belum ada batch</span>
                        @endif
                    </p>
                </div>

                @php
                    $now = \Carbon\Carbon::now();
                    $tanggalMulai = $kelas->batch ? \Carbon\Carbon::parse($kelas->batch->tanggal_mulai) : null;
                    $isClosed = $tanggalMulai ? $tanggalMulai->lte($now) : true;
                @endphp

                @if ($isClosed)
                    <span class="mt-4 inline-block bg-gray-400 text-white font-bold text-center py-2 px-4 rounded-lg cursor-not-allowed opacity-70">
                        Pendaftaran Ditutup
                    </span>
                @else
                    <a href="{{ route('daftar', ['idKelas' => $kelas->idKelas, 'jenis' => $kelas->jenis, 'namaKelas' => $kelas->namaKelas, 'harga' => $kelas->batch->harga ?? 0]) }}" 
                        class="mt-4 inline-block bg-primary text-white font-bold text-center py-2 px-4 rounded-lg hover:bg-orange-500 transition">
                        Daftar Sekarang
                    </a>
                @endif

            </div>
            @endforeach
        </div>
        @else
        <p class="text-white text-lg italic">Program belum tersedia untuk saat ini.</p>
        @endif
    </section>
    @endforeach

    <!-- SECTION: Event -->
    <section class="mb-12">
        <h2 class="text-3xl font-bold text-white mb-6">Informasi Event</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($events as $event)
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between h-full transition hover:shadow-xl">
                <img src="{{ asset('img/' . $event->gambar) }}" alt="{{ $event->namaEvent }}" class="rounded-lg w-full h-[250px] object-cover mb-4">
                <div>
                    <h3 class="text-xl font-bold text-secondary">{{ $event->namaEvent }}</h3>
                    <p class="text-gray-700 text-sm min-h-[60px]">{{ \Illuminate\Support\Str::limit($event->deskripsi, 100, '...') }}</p>
                    <p class="text-sm font-semibold text-primary mt-2">{{ $event->tanggal }} | {{ $event->lokasi }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

</div>
@endsection