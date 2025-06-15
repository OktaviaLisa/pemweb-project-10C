@extends('layout.login-layout')
@include('components.navbaradmin')
@section('content')

<div class="pt-36 bg-slate-100 min-h-screen pb-20"> {{-- bg dan jarak bawah ditambah --}}
    <h2 class="mb-10 text-2xl font-bold text-center text-primary">Daftar Bootcamp & Batch</h2>

    <div class="p-4 overflow-x-auto">
        <!-- Tombol Tambah Kelas -->
        <div class="mb-4 text-right">
            <a href="{{ url('tambahkelas?jenis=Bootcamp') }}" 
                class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                + Tambah Kelas
            </a>
        </div>

        <table class="w-full mb-15 border-collapse border border-gray-400 bg-white shadow-md table-auto rounded-lg overflow-hidden">
            <thead class="bg-secondary text-white">
                <tr>
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
                    <td class="border border-gray-300 px-4 py-2">  {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}</td>
                    <td class="text-lg font-bold text-secondary mt-2">
                        Rp {{ number_format((int) preg_replace('/[^0-9]/', '', $row->harga), 0, ',', '.') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <img src="{{ asset('img/' . $row->gambar) }}" alt="Gambar Kelas" class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('bootcamp.edit', $row->idKelas) }}" 
                                class="h-10 flex items-center justify-center bg-cyan-700 text-white px-4 py-2 rounded hover:bg-sky-950 transition">
                                Edit
                            </a>
                            <form action="{{ route('bootcamp.destroy') }}" method="POST" 
                                onsubmit="return confirm('Yakin ingin menghapus kelas ini?');" class="h-10">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $row->idKelas }}">
                                <button type="submit" 
                                        class="h-full flex items-center justify-center bg-[#c2410c] text-white px-4 py-2 rounded hover:bg-red-900 transition">
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