<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Event;

class KelasController extends Controller
{
    public function index()
    {
        // Ambil semua data kelas beserta batch-nya, lalu kelompokkan berdasarkan jenis
        $kelas_data = Kelas::with('batch')->get()->groupBy('jenis');

        // Ambil semua data event
        $events = Event::all();

        // Kirim data ke view kelas.blade.php
        return view('kelas', [
            'kelas_data' => $kelas_data,
            'events' => $events
        ]);
    }
}