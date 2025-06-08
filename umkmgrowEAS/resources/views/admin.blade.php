@extends('layout.login-layout')

@section('title', 'Admin Dashboard')
@include('components.navbaradmin')

@section('content')
<div id="dashboardContent" class="pt-24 container mx-auto">
    <h2 class="text-3xl font-bold text-center text-primary p-6 mb-6">Dashboard Admin</h2>

    <!-- Kotak Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Bootcamp -->
        <div class="bg-white rounded-lg shadow-md flex flex-col justify-between">
            <div class="flex items-center justify-between p-6 h-40 overflow-hidden">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-secondary">Bootcamp</h2>
                    <p class="text-black">Jumlah Bootcamp</p>
                    <p class="text-3xl font-bold text-primary">{{ $totalKelas }}</p>
                </div>
            </div>
            <a href="{{ url('bootcamp') }}" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-opacity-90 transition">
                Informasi selanjutnya
            </a>
        </div>

        <!-- Private Mentoring -->
        <div class="bg-white rounded-lg shadow-md flex flex-col justify-between">
            <div class="flex items-center justify-between p-6 h-40 overflow-hidden">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-secondary">Private Mentoring</h2>
                    <p class="text-black">Jumlah Private Mentoring</p>
                    <p class="text-3xl font-bold text-primary">{{ $totalMentoring }}</p>
                </div>
            </div>
            <a href="{{ url('mentoring') }}" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-opacity-90 transition">
                Informasi selanjutnya
            </a>
        </div>

        <!-- Event -->
        <div class="bg-white rounded-lg shadow-md flex flex-col justify-between">
            <div class="flex items-center justify-between p-6 h-40 overflow-hidden">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-secondary">Informasi Event</h2>
                    <p class="text-black">Jumlah Informasi Event</p>
                    <p class="text-3xl font-bold text-primary">{{ $totalEvent }}</p>
                </div>
            </div>
            <a href="{{ url('event') }}" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-opacity-90 transition">
                Informasi selanjutnya
            </a>
        </div>

        <!-- Peserta -->
        <div class="bg-white rounded-lg shadow-md flex flex-col justify-between">
            <div class="flex items-center justify-between p-6 h-40 overflow-hidden">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-secondary">Informasi Peserta</h2>
                    <p class="text-black">Jumlah Informasi Peserta</p>
                    <p class="text-3xl font-bold text-primary">{{ $totalPeserta }}</p>
                </div>
            </div>
            <a href="{{ url('peserta') }}" class="block text-center font-semibold bg-primary text-white py-2 rounded-b-lg hover:bg-opacity-90 transition">
                Informasi selanjutnya
            </a>
        </div>
    </div>

    <!-- Bagian grafik + tabel dibungkus agar bisa diexport -->
    <div id="exportArea">
        <!-- Grafik Bootcamp -->
        @if(count($labelsBootcamp) > 0)
        <section>
            <h2 class="text-3xl font-bold text-center text-primary mb-6">Grafik Pendaftar Bootcamp</h2>
            <div class="bg-white p-6 rounded-lg shadow-md max-w-5xl mx-auto mb-2">
                <canvas id="bootcampChart" height="100"></canvas>
            </div>

            <div class="bg-white mt-7 p-6 rounded-lg shadow-md max-w-5xl mx-auto mb-12 overflow-x-auto">
                <h3 class="text-xl text-center font-semibold text-gray-800 mb-4">Keterangan Jumlah Pendaftar Bootcamp:</h3>
                <table class="table-auto mx-auto text-center border-collapse border border-gray-300 w-full md:w-2/3">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th class="py-2 px-4 border">Nama Kelas</th>
                            <th class="py-2 px-4 border">Jumlah Pendaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($labelsBootcamp as $index => $label)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border font-semibold">{{ $label }}</td>
                            <td class="py-2 px-4 border">{{ $dataBootcamp[$index] }} pendaftar</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        @endif

        <!-- Grafik Mentoring -->
        @if(count($labelsMentoring) > 0)
        <section>
            <h2 class="text-3xl font-bold text-center text-primary mb-6">Grafik Pendaftar Private Mentoring</h2>
            <div class="bg-white p-6 rounded-lg shadow-md max-w-5xl mx-auto mb-2">
                <canvas id="mentoringChart" height="100"></canvas>
            </div>

            <div class="bg-white mt-7 p-6 rounded-lg shadow-md max-w-5xl mx-auto mb-12 overflow-x-auto">
                <h3 class="text-xl text-center font-semibold text-gray-800 mb-4">Keterangan Jumlah Pendaftar Private Mentoring:</h3>
                <table class="table-auto mx-auto text-center border-collapse border border-gray-300 w-full md:w-2/3">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th class="py-2 px-4 border">Nama Private Mentoring</th>
                            <th class="py-2 px-4 border">Jumlah Pendaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($labelsMentoring as $index => $label)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border font-semibold">{{ $label }}</td>
                            <td class="py-2 px-4 border">{{ $dataMentoring[$index] }} pendaftar</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        @endif
    </div>

    <!-- Tombol Download -->
    <div class="text-center mb-16">
        <button onclick="downloadDashboard()" title="Unduh seluruh grafik & tabel" class="bg-primary text-white font-semibold px-6 py-3 rounded hover:bg-opacity-90 transition">
            Download Report
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    const bootcampLabels = @json($labelsBootcamp);
    const bootcampData = @json($dataBootcamp);
    const mentoringLabels = @json($labelsMentoring);
    const mentoringData = @json($dataMentoring);

    if (bootcampLabels.length > 0) {
        new Chart(document.getElementById('bootcampChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: bootcampLabels,
                datasets: [{
                    label: 'Jumlah Pendaftar Bootcamp',
                    data: bootcampData,
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    }

    if (mentoringLabels.length > 0) {
        new Chart(document.getElementById('mentoringChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: mentoringLabels,
                datasets: [{
                    label: 'Jumlah Pendaftar Private Mentoring',
                    data: mentoringData,
                    backgroundColor: 'rgba(16, 185, 129, 0.6)',
                    borderColor: 'rgba(5, 150, 105, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    }

    async function downloadDashboard() {
        const { jsPDF } = window.jspdf;
        const content = document.getElementById('exportArea');
        const button = document.querySelector('button[onclick="downloadDashboard()"]');
        button.style.display = 'none';

        const canvas = await html2canvas(content, { scale: 2, useCORS: true, backgroundColor: '#ffffff' });
        button.style.display = 'inline-block';

        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'mm', 'a4');
        const pageWidth = 210;
        const margin = 15;
        const imgWidth = pageWidth - margin * 2;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        pdf.text("Laporan UMKMGrow", pageWidth / 2, margin, { align: "center" });
        pdf.addImage(imgData, 'PNG', margin, margin + 5, imgWidth, imgHeight);
        pdf.save("laporan-umkmgrow.pdf");
    }
</script>
@endpush