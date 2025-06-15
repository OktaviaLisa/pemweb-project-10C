@extends('layout.login-layout')
@section('content')

<div class="min-h-screen bg-secondary py-10"> 
<div class="pt-36 max-w-xl mx-auto">
   
    <form action="{{ $mode == 'tambah' ? url('/event/simpan') : url('/event/update/'.$data->idEvent) }}" 
          method="POST" enctype="multipart/form-data" 
          class="bg-white p-6 rounded shadow-md">
        @csrf
         <h2 class="text-2xl font-bold text-center mb-6 text-primary">
        {{ $mode == 'tambah' ? 'Tambah Event' : 'Edit Event' }}
        </h2>
        <div class="mb-4">
            <label class="block font-semibold mb-2">Nama Event</label>
            <input type="text" name="namaEvent" 
                   value="{{ $mode == 'edit' ? $data->namaEvent : '' }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="4" 
                      class="w-full border border-gray-300 rounded px-3 py-2" required>{{ $mode == 'edit' ? $data->deskripsi : '' }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Tanggal</label>
            <input type="date" name="tanggal" 
                   value="{{ $mode == 'edit' ? $data->tanggal : '' }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Lokasi</label>
            <input type="text" name="lokasi" 
                   value="{{ $mode == 'edit' ? $data->lokasi : '' }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Gambar {{ $mode == 'tambah' ? '(wajib)' : '(opsional)' }}</label>
            <input type="file" name="gambar" 
                   class="w-full border border-gray-300 rounded px-3 py-2" 
                   {{ $mode == 'tambah' ? 'required' : '' }}>
            @if($mode == 'edit')
                <img src="{{ asset('img/' . $data->gambar) }}" 
                     alt="Gambar Event" class="w-32 h-32 object-cover mt-3 rounded">
            @endif
        </div>

        <div class="text-right">
            <button type="submit" 
                   class="w-full bg-primary text-white py-3 rounded font-semibold hover:bg-orange-500 transition">
                {{ $mode == 'tambah' ? 'Simpan' : 'Simpan' }}
            </button>
        </div>

    </form>
</div>

@endsection