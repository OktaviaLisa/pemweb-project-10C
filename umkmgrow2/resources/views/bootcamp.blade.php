@extends('layout.login-layout')
@include('components.navbaradmin')
@section('content')

<div class="pt-36">
    <h2 class="mb-10 text-2xl font-bold text-center text-primary">Daftar Bootcamp & Batch</h2>

    <div class="bg-white shadow-md rounded-lg p-4 overflow-x-auto">
        <!-- Tombol Tambah Kelas -->
        <div class="mb-4 text-right">
            <a href="{{ url('tambahkelas?jenis=Bootcamp') }}" 
                class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                + Tambah Kelas
            </a>

        </div>

        <table class="w-full mb-4 border-collapse border border-gray-400 bg-white shadow-md table-auto">
            <thead class="bg-secondary text-white">
                <tr class="bg-secondary">
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Kelas</th>
                    <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                    <th class="border border-gray-300 px-4 py-2">Batch</th>
                    <th class="border border-gray-300 px-4 py-2">Harga</th>
                    <th class="border border-gray-300 px-4 py-2">Gambar</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($data as $row)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $no++ }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $row->namaKelas }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $row->deskripsi }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $row->tanggal_mulai }}</td>
                    <td class="text-lg font-bold text-secondary mt-2">
                        Rp {{ number_format((int) preg_replace('/[^0-9]/', '', $row->harga), 0, ',', '.') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                       <img src="{{ asset('img/' . $row->gambar) }}" alt="Gambar Kelas" class="w-16 h-16 object-cover">
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('bootcamp.edit', $row->idKelas) }}" 
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                            Edit
                            </a>
                           <form action="{{ route('bootcamp.destroy') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $row->idKelas }}">
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
