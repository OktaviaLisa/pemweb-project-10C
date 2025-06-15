@extends('layout.login-layout')
@section('content')
@include('components.navbaradmin')

<div class="pt-36 bg-slate-100 min-h-screen pb-20"> {{-- disamakan dengan bootcamp dan mentoring --}}
    <h2 class="mb-10 text-2xl font-bold text-center text-primary">Daftar Event</h2>

    <div class="p-4 overflow-x-auto"> {{-- disamakan --}}
        <!-- Tombol Tambah Event -->
        <div class="mb-4 text-right">
            <a href="/event/tambah" 
               class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                + Tambah Event
            </a>
        </div>

        <table class="w-full mb-15 border-collapse border border-gray-400 bg-white shadow-md table-auto rounded-lg overflow-hidden">
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
                               class="h-10 flex items-center justify-center bg-cyan-700 text-white px-4 py-2 rounded hover:bg-sky-950 transition">
                                Edit
                            </a>
                            <form action="/event/hapus/{{ $event->idEvent }}" method="POST" onsubmit="return confirm('Hapus event ini?');" class="h-10">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="h-full flex items-center justify-center bg-[#c2410c] text-white px-4 py-2 rounded hover:bg-red-900 transition">
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