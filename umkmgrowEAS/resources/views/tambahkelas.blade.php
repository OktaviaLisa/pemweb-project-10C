@extends('layout.login-layout')
@section('content')

@php
    $jenis = request('jenis');
    $route = $jenis === 'Mentoring' ? 'mentoring.store' : 'bootcamp.store';
@endphp

<div class="pt-36 max-w-xl mx-auto">
    <h2 class="text-2xl font-bold text-center mb-6 text-primary">Tambah Kelas {{ $jenis }}</h2>

    <form action="{{ route($route) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        <input type="hidden" name="jenis" value="{{ $jenis }}">

        <div class="mb-4">
            <label class="block font-semibold mb-2">Nama Kelas</label>
            <input type="text" name="namaKelas" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border border-gray-300 rounded px-3 py-2" rows="4" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Gambar (opsional)</label>
            <input type="file" name="gambar" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Harga</label>
            <input type="number" name="harga" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>

@endsection
