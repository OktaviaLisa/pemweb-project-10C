<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function tampilKonfirmasi(Request $request)
    {
        // Ambil metode pembayaran dari form
        $metode_pembayaran = $request->input('metode_pembayaran');
        session(['metode_pembayaran' => $metode_pembayaran]);

        // Ambil data lain dari session
        $email = session('email');
        $idKelas = session('idKelas');
        $batch_id = session('batch_id');
        $harga = session('harga');

        // Generate kode VA unik
        $kode_va = strtoupper($metode_pembayaran) . rand(100000, 999999);
        session(['kode_va' => $kode_va]);

        // Simpan ke database
        DB::table('kelaskeranjang')->insert([
            'email' => $email,
            'kelas_id' => $idKelas,
            'batch_id' => $batch_id,
            'metode_pembayaran' => $metode_pembayaran,
            'kode_va' => $kode_va,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tampilkan view konfirmasi
        return view('konfirmasibayar', compact(
            'email',
            'idKelas',
            'batch_id',
            'metode_pembayaran',
            'harga',
            'kode_va'
        ));
    }
}