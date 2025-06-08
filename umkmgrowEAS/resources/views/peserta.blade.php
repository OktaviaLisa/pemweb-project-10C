@extends('layout.login-layout')
@include('components.navbaradmin')
@section('title', 'Data Peserta')

@section('content')
<div class="pt-24 container mx-auto">
    <h2 class="text-3xl font-bold text-center text-primary p-6 mb-6">Data Peserta</h2>

    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <table class="w-full text-center table-auto border-collapse border border-gray-300">
            <thead class="bg-secondary text-white">
                <tr>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Nama Kelas</th>
                    <th class="py-2 px-4 border">Tanggal Mulai Batch</th>
                    <th class="py-2 px-4 border">Metode Pembayaran</th>
                    <th class="py-2 px-4 border">Kode VA</th>
                    <th class="py-2 px-4 border">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peserta as $data)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $data->email }}</td>
                    <td class="py-2 px-4 border">{{ $data->namaKelas }}</td>
                    <td class="py-2 px-4 border">{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') }}</td>
                    <td class="py-2 px-4 border">{{ $data->metode_pembayaran }}</td>
                    <td class="py-2 px-4 border">{{ $data->kode_va }}</td>
                    <td class="py-2 px-4 border">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
