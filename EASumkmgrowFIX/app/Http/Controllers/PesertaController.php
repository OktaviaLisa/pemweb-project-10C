<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Keranjang;
use App\Models\Kelas;
use App\Models\Batch;

class PesertaController extends Controller {

    public function index()
{
    $peserta = DB::table('kelaskeranjang')
        ->join('kelas', 'kelaskeranjang.kelas_id', '=', 'kelas.idKelas')
        ->join('batch', 'kelaskeranjang.batch_id', '=', 'batch.idbatch')
        ->select(
            'kelaskeranjang.id',
            'kelaskeranjang.email',
            'kelas.namaKelas',
            'batch.tanggal_mulai',
            'kelaskeranjang.metode_pembayaran',
            'kelaskeranjang.kode_va',
            'kelaskeranjang.created_at'
        )
        ->orderBy('kelaskeranjang.created_at', 'desc')
        ->get();

    return view('peserta', compact('peserta'));
}

}
