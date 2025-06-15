<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelasKeranjang;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Batch;


class KelasKeranjangController extends Controller
{
    public function index()
    {
        $email = Auth::user()->email;

        // Ambil data keranjang beserta kelas dan batch-nya dengan relasi
        $kelas_data = KelasKeranjang::with(['kelas', 'batch'])
            ->where('email', $email)
            ->get();

        // Data chart buat hitung jumlah kelas yang ada di keranjang user
        $chart_data = KelasKeranjang::select('kelas_id', DB::raw('count(id) as jumlah_kelas'))
            ->where('email', $email)
            ->groupBy('kelas_id')
            ->with('kelas')
            ->get();

        return view('kelaskeranjang', [
            'kelas_data' => $kelas_data,
            'chart_labels' => $chart_data->pluck('kelas.namaKelas'),
            'chart_counts' => $chart_data->pluck('jumlah_kelas'),
        ]);
    }

    public function showDaftar(Request $request)
{
    $idKelas = $request->query('idKelas');
    $jenis = $request->query('jenis');
    $namaKelas = $request->query('namaKelas');
    $harga = $request->query('harga');

    $batchList = \App\Models\Batch::where('idKelas', $idKelas)->get();

    return view('daftar', [
        'idKelas' => $idKelas,
        'jenis' => $jenis,
        'namaKelas' => $namaKelas,
        'harga' => $harga,
        'batchList' => $batchList,
        'email' => Auth::check() ? Auth::user()->email : '',
    ]);
}

// Simpan data dari form daftar ke session, lalu redirect ke prosesbayar
    public function simpanSession(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required',
            'batch_id' => 'required',
            'harga' => 'required',
        ]);

        session([
            'idKelas' => $request->kelas_id,
            'batch_id' => $request->batch_id,
            'harga' => $request->harga,
            'email' => Auth::user()->email,
        ]);

        return redirect()->route('prosesbayar');
    }

    // Tampilkan halaman proses bayar dengan data dari session
    public function showProsesBayar()
    {
        if (!session()->has(['idKelas', 'batch_id', 'harga', 'email'])) {
            return redirect()->route('daftar')->with('error', 'Data tidak lengkap, silakan daftar ulang.');
        }

        $idKelas = session('idKelas');
        $batch_id = session('batch_id');
        $harga = session('harga');
        $email = session('email');

        $kelas = Kelas::find($idKelas);
        $batch = Batch::find($batch_id);

        if (!$kelas || !$batch) {
            return redirect()->route('daftar')->with('error', 'Data kelas atau batch tidak ditemukan.');
        }

        return view('prosesbayar', compact('email', 'kelas', 'batch', 'harga'));
    }

    public function bayar(Request $request)
    {
        // Contoh ambil data pembayaran
        $bank = $request->input('bank');
        $email = session('email');
        $idKelas = session('idKelas');
        $batch_id = session('batch_id');
        $harga = session('harga');

        return redirect()->route('home')->with('success', 'Pembayaran berhasil via ' . $bank);
    }

    public function terdaftar()
{
    $email = Auth::user()->email;

    // Ambil data keranjang 
    $kelas_data = KelasKeranjang::with(['kelas', 'batch'])
        ->where('email', $email)
        ->get();

    // Data untuk grafik
    $chart_data = KelasKeranjang::select('kelas_id', DB::raw('count(id) as jumlah_kelas'))
        ->where('email', $email)
        ->groupBy('kelas_id')
        ->with('kelas')
        ->get();

    return view('kelaskeranjang', [
        'kelas_data' => $kelas_data,
        'chart_labels' => $chart_data->pluck('kelas.namaKelas'),
        'chart_counts' => $chart_data->pluck('jumlah_kelas'),
    ]);
}


}