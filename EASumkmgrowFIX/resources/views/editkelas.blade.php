@extends('layout.login-layout')

@php
    
    $jenis = $jenis ?? 'Bootcamp'; // default Bootcamp kalau kosong

    $routeStore = $jenis === 'Private Mentoring' ? 'mentoring.store' : 'bootcamp.store';
    $routeUpdate = $jenis === 'Private Mentoring' ? 'mentoring.update' : 'bootcamp.update';

    // Judul form
    $judulForm = isset($kelas) ? 'Edit' : 'Tambah';
@endphp

@section('content')
<div class="min-h-screen bg-secondary py-10"> 
<div class="pt-36 max-w-xl mx-auto">
<div  class="bg-white p-6 rounded shadow-md">
    <h2 class="mb-6 text-2xl font-bold text-center text-primary">
        {{ $judulForm }} Kelas {{ $jenis }}
    </h2>

    <form action="{{ isset($kelas) ? route($routeUpdate, $kelas->idKelas) : route($routeStore) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($kelas))
            @method('PUT')
        @endif

        <!-- Hidden input jenis -->
        <input type="hidden" name="jenis" value="{{ $jenis }}">

        <!-- Nama Kelas -->
        <label for="namaKelas" class="block font-semibold mb-1">Nama Kelas</label>
        <input type="text" name="namaKelas" id="namaKelas" 
               value="{{ old('namaKelas', $kelas->namaKelas ?? '') }}" 
               class="w-full mb-4 px-3 py-2 border rounded" required>
        @error('namaKelas')
            <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
        @enderror

        <!-- Deskripsi -->
        <label for="deskripsi" class="block font-semibold mb-1">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="4" 
                  class="w-full mb-4 px-3 py-2 border rounded" required>{{ old('deskripsi', $kelas->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
        @enderror

        <!-- Gambar -->
        <label for="gambar" class="block font-semibold mb-1">Gambar</label>
        <input type="file" name="gambar" id="gambar" class="mb-4">
        @if (!empty($kelas->gambar))
        <div class="mb-4">
                <img src="{{ asset('img/' . $kelas->gambar) }}" alt="Gambar Kelas" class="w-32 h-32 object-cover rounded">
            </div>
        @endif

        @error('gambar')
            <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
        @enderror

        <!-- Batch - Tanggal Mulai -->
        <label for="tanggal_mulai" class="block font-semibold mb-1">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
               value="{{ old('tanggal_mulai', $batch->tanggal_mulai ?? '') }}" 
               class="w-full mb-4 px-3 py-2 border rounded" required>
        @error('tanggal_mulai')
            <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
        @enderror

        <!-- Batch - Tanggal Selesai -->
        <label for="tanggal_selesai" class="block font-semibold mb-1">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" id="tanggal_selesai" 
               value="{{ old('tanggal_selesai', $batch->tanggal_selesai ?? '') }}" 
               class="w-full mb-4 px-3 py-2 border rounded" required>
        @error('tanggal_selesai')
            <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
        @enderror

        <!-- Harga -->
        <label for="harga" class="block font-semibold mb-1">Harga Batch</label>
        <input type="number" name="harga" id="harga" 
               value="{{ old('harga', $batch->harga ?? '') }}" 
               class="w-full mb-6 px-3 py-2 border rounded" required>
        @error('harga')
            <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
        @enderror

        <button type="submit" 
                class="w-full bg-primary text-white py-3 rounded font-semibold hover:bg-orange-500 transition">
            {{ $judulForm === 'Edit' ? 'Simpan Perubahan' : 'Tambah ' . $jenis }}
        </button>
    </form>
</div>
@endsection
