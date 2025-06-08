<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KonfirmasiController extends Controller
{
    public function konfirmasi(Request $request)
    {
        // Validasi input
        $request->validate([
            'metode_pembayaran' => 'required|string',
        ]);

        // Ambil data dari session
        $email = session('email');
        $idKelas = session('idKelas');
        $batch_id = session('batch_id');
        $harga = session('harga');
        $metode = $request->input('metode_pembayaran');
        $kode_va = strtoupper($metode) . rand(100000, 999999);

        // Simpan ke DB
        DB::table('kelaskeranjang')->insert([
            'email' => $email,
            'kelas_id' => $idKelas,
            'batch_id' => $batch_id,
            'metode_pembayaran' => $metode,
            'kode_va' => $kode_va
        ]);

        // Simpan ke session untuk ditampilkan di view
        session([
            'metode_pembayaran' => $metode,
            'kode_va' => $kode_va
        ]);

        return view('pembayaran.konfirmasi', [
            'metode' => $metode,
            'kode_va' => $kode_va,
            'harga' => $harga
        ]);
    }
}
