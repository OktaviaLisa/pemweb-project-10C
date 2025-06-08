<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung jumlah kelas bootcamp
        $totalKelas = DB::table('kelas')->where('jenis', 'bootcamp')->count();

        // Hitung jumlah private mentoring
        $totalMentoring = DB::table('kelas')->where('jenis', 'private mentoring')->count();

        // Hitung jumlah peserta (users)
        $totalPeserta = DB::table('users')->count();

        // Hitung jumlah event
        $totalEvent = DB::table('infoevent')->count();

        // Hitung total pendapatan
        $totalPendapatan = DB::table('kelaskeranjang')
            ->join('batch', 'kelaskeranjang.batch_id', '=', 'batch.idBatch')
            ->sum('batch.harga');

        // Hitung pendapatan Bootcamp
        $pendapatanBootcamp = DB::table('kelaskeranjang')
            ->join('batch', 'kelaskeranjang.batch_id', '=', 'batch.idBatch')
            ->join('kelas', 'batch.idKelas', '=', 'kelas.idKelas')
            ->where('kelas.jenis', 'Bootcamp')
            ->sum('batch.harga');

        // Hitung pendapatan Private Mentoring
        $pendapatanMentoring = DB::table('kelaskeranjang')
            ->join('batch', 'kelaskeranjang.batch_id', '=', 'batch.idBatch')
            ->join('kelas', 'batch.idKelas', '=', 'kelas.idKelas')
            ->where('kelas.jenis', 'Private Mentoring')
            ->sum('batch.harga');

        // Data chart bootcamp
        $bootcampData = DB::table('kelas')
            ->leftJoin('kelaskeranjang', 'kelas.idKelas', '=', 'kelaskeranjang.kelas_id')
            ->select('kelas.namaKelas', DB::raw('COUNT(kelaskeranjang.id) as jumlah'))
            ->where('kelas.jenis', 'Bootcamp')
            ->groupBy('kelas.namaKelas')
            ->get();

        $labelsBootcamp = $bootcampData->pluck('namaKelas')->toArray();
        $dataBootcamp = $bootcampData->pluck('jumlah')->toArray();

        // Data chart private mentoring
        $mentoringData = DB::table('kelas')
            ->leftJoin('kelaskeranjang', 'kelas.idKelas', '=', 'kelaskeranjang.kelas_id')
            ->select('kelas.namaKelas', DB::raw('COUNT(kelaskeranjang.id) as jumlah'))
            ->where('kelas.jenis', 'Private Mentoring')
            ->groupBy('kelas.namaKelas')
            ->get();

        $labelsMentoring = $mentoringData->pluck('namaKelas')->toArray();
        $dataMentoring = $mentoringData->pluck('jumlah')->toArray();

        return view('admin', compact(
            'totalKelas',
            'totalMentoring',
            'totalPeserta',
            'totalEvent',
            'totalPendapatan',
            'pendapatanBootcamp',
            'pendapatanMentoring',
            'labelsBootcamp',
            'dataBootcamp',
            'labelsMentoring',
            'dataMentoring'
        ));
    }
}
