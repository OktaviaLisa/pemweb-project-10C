@extends('layout.login-layout')
@section('content')
@include('components.navbaradmin')

<div class="pt-36">
    <h2 class="mb-10 text-2xl font-bold text-center text-primary">Daftar Event</h2>

    <div class="bg-white shadow-md rounded-lg p-4 overflow-x-auto">
        <!-- Tombol Tambah Event -->
        <div class="mb-4 text-right">
            <a href="/event/tambah" 
               class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                + Tambah Event
            </a>
        </div>

        <table class="w-full mb-4 border-collapse border border-gray-400 bg-white shadow-md table-auto">
            <thead class="bg-secondary text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Event</th>
                    <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                    <th class="border border-gray-300 px-4 py-2">Lokasi</th>
                    <th class="border border-gray-300 px-4 py-2">Gambar</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($data as $event)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $no++ }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $event->namaEvent }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $event->deskripsi }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $event->tanggal }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $event->lokasi }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <img src="{{ asset('img/' . $event->gambar) }}" alt="Gambar Event" class="w-16 h-16 object-cover mx-auto rounded">
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="flex justify-center gap-2">
                            <a href="/event/edit/{{ $event->idEvent }}" 
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                Edit
                            </a>
                            <form action="/event/hapus/{{ $event->idEvent }}" method="POST" onsubmit="return confirm('Hapus event ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection