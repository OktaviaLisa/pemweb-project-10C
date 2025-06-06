@extends('layout.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Data Kelas Keranjang</h1>

    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden mb-8">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-3 px-6 text-left">No</th>
                <th class="py-3 px-6 text-left">Nama Kelas</th>
                <th class="py-3 px-6 text-left">Jenis</th>
                <th class="py-3 px-6 text-left">Tanggal</th>
                <th class="py-3 px-6 text-left">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas_data as $index => $data)
                <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                    <td class="py-3 px-6">{{ $index + 1 }}</td>
                    <td class="py-3 px-6">{{ $data->kelas->namaKelas ?? '-' }}</td>
                    <td class="py-3 px-6">{{ $data->kelas->jenis ?? '-' }}</td>
                    <td class="py-3 px-6">{{ $data->batch->tanggal ?? '-' }}</td>
                    <td class="py-3 px-6">
                        Rp{{ number_format($data->batch->harga ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="text-2xl font-semibold mb-4">Grafik Jumlah Kelas</h2>

    <!-- Chart container dengan tinggi terbatas -->
    <div class="w-full max-w-md mx-auto h-80 relative mb-8">
        <canvas id="kelasChart" class="absolute top-0 left-0 w-full h-full"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kelasChart').getContext('2d');
        const kelasChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chart_labels) !!},
                datasets: [{
                    label: 'Jumlah Kelas',
                    data: {!! json_encode($chart_counts) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(201, 203, 207, 0.7)',
                        'rgba(100, 255, 218, 0.7)',
                    ],
                    borderColor: 'white',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
            }
        });
    </script>
@endsection