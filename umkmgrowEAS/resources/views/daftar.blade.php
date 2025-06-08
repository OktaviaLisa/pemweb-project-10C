@extends('layout.app')
@include('components.navbar')

@section('content')
<section id="pendaftaran" class="pt-36 pb-32">
    <div class="container">
        <form method="POST" action="{{ route('simpan.session.dan.ke.prosesbayar') }}">
            @csrf
            <div class="w-full lg:w-2/3 lg:mx-auto">

                {{-- Email --}}
                <div class="w-full px-6 md-8 mb-5">
                    <label for="email" class="text-base font-bold text-secondary">Email</label>
                    <input type="email" id="email" name="email" value="{{ $email }}" readonly
                        class="w-full bg-slate-200 text-black p-3 rounded-md" />
                </div>

                {{-- Jenis --}}
                <div class="w-full px-6 md-8 mb-5">
                    <label for="jenis" class="text-base font-bold text-secondary">Jenis</label>
                    <input type="text" id="jenis" name="jenis" value="{{ $jenis }}" readonly
                        class="w-full bg-slate-200 text-black p-3 rounded-md" />
                </div>

                {{-- Nama Kelas --}}
                <div class="w-full px-6 md-8 mb-5">
                    <label for="kelas_tampil" class="text-base font-bold text-secondary">Kelas</label>
                    <input type="text" id="kelas_tampil" value="{{ $namaKelas }}" readonly
                        class="w-full bg-slate-200 text-black p-3 rounded-md" />
                    <input type="hidden" name="kelas_id" value="{{ $idKelas }}">
                </div>

                {{-- Pilih Batch --}}
                <div class="w-full px-6 md-8 mb-5">
                    <label for="batch" class="text-base font-bold text-secondary">Pilih Batch</label>
                   <select id="batch" name="batch_id" required
                    class="w-full bg-slate-200 text-black p-3 rounded-md focus:outline-none focus:ring-secondary focus:ring-1 focus:border-secondary">
                    <option value="">Pilih Batch</option>
                    @foreach ($batchList as $batch)
                        <option value="{{ $batch->idbatch }}" data-harga="{{ $batch->harga }}">
                            {{ $batch->tanggal }}
                        </option>
                    @endforeach
                </select>
                </div>

                {{-- Harga --}}
                <div class="w-full px-6 md-8 mb-5">
                    <label for="harga_display" class="text-base font-bold text-secondary">Harga</label>
                    <input type="text" id="harga_display"
                        value="Rp {{ number_format((int) $harga, 0, ',', '.') }}" readonly
                        class="w-full bg-slate-200 text-black p-3 rounded-md" />
                    <input type="hidden" id="harga" name="harga" value="{{ $harga }}">
                </div>

                {{-- Tombol --}}
                <div class="flex justify-between items-center mt-6 px-6 md:px-8">
                    <a href="{{ route('home') }}"
                        class="w-40 text-center bg-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-orange-500 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-60 text-center bg-secondary text-white font-bold py-3 px-6 rounded-lg hover:shadow-lg transition">
                        Lanjut Pembayaran
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    const batchDropdown = document.getElementById('batch');
    const hargaInput = document.getElementById('harga');
    const hargaDisplay = document.getElementById('harga_display');

    batchDropdown.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const harga = selected.getAttribute('data-harga');

        hargaInput.value = harga;
        hargaDisplay.value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(harga);
    });
</script>
@endsection