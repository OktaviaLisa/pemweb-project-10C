@extends('layout.app')

@section('content')
<div class="min-h-screen bg-slate-100 pt-28 px-4 sm:px-6 md:px-20 py-10">
    <h1 class="text-3xl font-bold mb-6 text-secondary">Data Kelas Keranjang</h1>

    @if (count($kelas_data) > 0)
        <!-- TABEL -->
        <div class="overflow-x-auto mb-8 rounded-lg shadow">
            <table class="w-full bg-white text-sm rounded-lg overflow-hidden">
                <thead style="background-color: #164e63;" class="text-white">
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
                            <td class="py-3 px-6">
                                @php
                                    $mulai = $data->batch->tanggal_mulai ?? null;
                                    $selesai = $data->batch->tanggal_selesai ?? null;
                                @endphp

                                @if ($mulai && $selesai)
                                    {{ \Carbon\Carbon::parse($mulai)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($selesai)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-3 px-6">
                                Rp{{ number_format($data->batch->harga ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center font-semibold text-primary text-3xl mt-40">Kamu belum mendaftar kelas 😔</p>
    @endif

    @if (count($kelas_data) > 0)
    <h2 class="text-3xl font-bold mb-6 text-secondary">Grafik Jumlah Kelas</h2>

    <div class="flex flex-col md:flex-row gap-6 items-start justify-center md:items-start md:justify-center md:space-x-8">
        <!-- Grafik -->
        <div class="w-full max-w-xs sm:max-w-sm aspect-[1/1] relative mx-auto">
            <canvas id="kelasChart" class="absolute top-0 left-0 w-full h-full"></canvas>
        </div>

        <!-- Kotak Rincian -->
        <div class="bg-white rounded-xl shadow px-6 py-4 w-full max-w-md mx-auto md:mx-0">
            @php
                $bootcamp = [];
                $mentoring = [];

                foreach ($kelas_data as $data) {
                    $nama = $data->kelas->namaKelas ?? '-';
                    $jenis = strtolower($data->kelas->jenis ?? '-');

                    if ($jenis === 'bootcamp') {
                        $bootcamp[$nama] = ($bootcamp[$nama] ?? 0) + 1;
                    } elseif ($jenis === 'private mentoring') {
                        $mentoring[$nama] = ($mentoring[$nama] ?? 0) + 1;
                    }
                }
            @endphp

            @if(count($bootcamp) > 0)
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-cyan-800 mb-2">Bootcamp:</h3>
                    <ul class="list-disc list-inside text-black text-sm">
                        @foreach ($bootcamp as $nama => $jumlah)
                            <li>{{ $nama }} = {{ $jumlah }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(count($mentoring) > 0)
                <div>
                    <h3 class="text-lg font-semibold text-cyan-800 mb-2">Private Mentoring:</h3>
                    <ul class="list-disc list-inside text-black text-sm">
                        @foreach ($mentoring as $nama => $jumlah)
                            <li>{{ $nama }} = {{ $jumlah }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    @endif
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