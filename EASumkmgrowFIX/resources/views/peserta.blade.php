@extends('layout.login-layout')
@include('components.navbaradmin')
@section('title', 'Data Peserta')

@section('content')
<div class="pt-36 bg-slate-100 min-h-screen pb-20">
    <h2 class="text-2xl font-bold text-center text-primary mb-10">Data Peserta</h2>

    <div class="max-w-7xl mx-auto px-6 overflow-x-auto">
        <table class="w-full table-auto border border-gray-300 border-collapse rounded-xl overflow-hidden bg-white shadow-md">
            <thead class="bg-secondary text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Kelas</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal Mulai Batch</th>
                    <th class="border border-gray-300 px-4 py-2">Metode Pembayaran</th>
                    <th class="border border-gray-300 px-4 py-2">Kode VA</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peserta as $data)
                <tr class="text-center hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $data->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->namaKelas }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->metode_pembayaran }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->kode_va }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection