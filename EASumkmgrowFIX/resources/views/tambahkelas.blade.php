@extends('layout.login-layout')
@section('content')

@php
    $jenis = request('jenis');
    $route = $jenis === 'Mentoring' ? 'mentoring.store' : 'bootcamp.store';
@endphp

<div class="min-h-screen bg-secondary py-10"> 
<div class="pt-36 max-w-xl mx-auto">
   

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-400 rounded">
            <strong>Periksa kembali isian Anda:</strong>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route($route) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
         <h2 class="text-2xl font-bold text-center mb-6 text-primary">Tambah Kelas {{ $jenis }}</h2>
        @csrf
        <input type="hidden" name="jenis" value="{{ $jenis }}">

        <div class="mb-4">
            <label class="block font-semibold mb-2">Nama Kelas</label>
            <input type="text" name="namaKelas" value="{{ old('namaKelas') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border border-gray-300 rounded px-3 py-2" rows="4" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Gambar</label>
            <input type="file" name="gambar" class="w-full border border-gray-300 rounded px-3 py-2" required>
            
            {{-- Error message ditampilkan di sini --}}
            @error('gambar')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-4">
            <label class="block font-semibold mb-2">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Harga</label>
            <input type="number" name="harga" value="{{ old('harga') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="text-right">
            <button type="submit" class="w-full bg-primary text-white py-3 rounded font-semibold hover:bg-orange-500 transition">Simpan</button>
        </div>
    </form>
</div>

@endsection