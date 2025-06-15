<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BootcampController extends Controller
{
    public function index()
    {
        $data = DB::table('kelas')
            ->leftJoin('batch', 'kelas.idKelas', '=', 'batch.idKelas')
            ->select(
                'kelas.idKelas',
                'kelas.namaKelas',
                'kelas.deskripsi',
                'kelas.gambar',
                'kelas.jenis',
                'batch.idbatch',
                'batch.tanggal_mulai',
                'batch.tanggal_selesai',
                'batch.harga',
                'batch.status'
            )
            ->where('kelas.jenis', 'Bootcamp')
            ->get();

        return view('bootcamp', compact('data'));
    }

    public function mentoring()
    {
        $data = DB::table('kelas')
            ->leftJoin('batch', 'kelas.idKelas', '=', 'batch.idKelas')
            ->select(
                'kelas.idKelas',
                'kelas.namaKelas',
                'kelas.deskripsi',
                'kelas.gambar',
                'kelas.jenis',
                'batch.idbatch',
                'batch.tanggal_mulai',
                'batch.tanggal_selesai',
                'batch.harga',
                'batch.status'
            )
            ->where('kelas.jenis', 'Private Mentoring')
            ->get();

        return view('mentoring', compact('data'));
    }

    public function create(Request $request)
    {
        $jenis = $request->query('jenis');

        if (!in_array($jenis, ['Bootcamp', 'Private Mentoring'])) {
            abort(404, 'Jenis kelas tidak valid.');
        }

        return view('tambahkelas', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKelas' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'harga' => 'required|numeric',
            'jenis' => 'required|in:Bootcamp,Private Mentoring',
        ]);

        $dataKelas = [
            'namaKelas' => $request->namaKelas,
            'deskripsi' => $request->deskripsi,
            'jenis' => $request->jenis,
        ];

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('img'), $namaFile);
            $dataKelas['gambar'] = $namaFile;
        }

        $idKelas = DB::table('kelas')->insertGetId($dataKelas);

        DB::table('batch')->insert([
            'idKelas' => $idKelas,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'harga' => $request->harga,
            'status' => 'aktif',
        ]);

        if ($request->jenis === 'Private Mentoring') {
            return redirect()->route('mentoring.index')->with('success', 'Kelas mentoring berhasil ditambahkan.');
        }

        return redirect()->route('bootcamp.index')->with('success', 'Kelas bootcamp berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas = DB::table('kelas')->where('idKelas', $id)->first();
        $batch = DB::table('batch')->where('idKelas', $id)->first();

        if (!$kelas) {
            abort(404);
        }

        $jenis = $kelas->jenis;

        return view('editkelas', compact('kelas', 'batch', 'jenis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaKelas' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'harga' => 'required|numeric',
            'jenis' => 'required|in:Bootcamp,Private Mentoring',
        ]);

        $kelas = DB::table('kelas')->where('idKelas', $id)->first();
        if (!$kelas) {
            abort(404);
        }

        $dataUpdate = [
            'namaKelas' => $request->namaKelas,
            'deskripsi' => $request->deskripsi,
            'jenis' => $request->jenis,
        ];

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = $gambar->getClientOriginalName();
            $gambar->move(public_path('img'), $namaFile);
            $dataUpdate['gambar'] = $namaFile;
        }

        DB::table('kelas')->where('idKelas', $id)->update($dataUpdate);

        DB::table('batch')->where('idKelas', $id)->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'harga' => $request->harga,
        ]);

        if ($request->jenis === 'Private Mentoring') {
            return redirect()->route('mentoring.index')->with('success', 'Kelas mentoring berhasil diperbarui.');
        }

        return redirect()->route('bootcamp.index')->with('success', 'Kelas bootcamp berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $kelas = DB::table('kelas')->where('idKelas', $id)->first();
        if (!$kelas) {
            abort(404);
        }

        DB::table('batch')->where('idKelas', $id)->delete();
        DB::table('kelas')->where('idKelas', $id)->delete();

        if ($kelas->jenis === 'Private Mentoring') {
            return redirect()->route('mentoring.index')->with('success', 'Kelas mentoring berhasil dihapus.');
        }

        return redirect()->route('bootcamp.index')->with('success', 'Kelas bootcamp berhasil dihapus.');
    }

    public function mentoringUpdate(Request $request, $id)
    {
        $request->validate([
            'namaKelas' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'harga' => 'required|numeric',
        ]);

        $kelas = DB::table('kelas')->where('idKelas', $id)->first();
        if (!$kelas) {
            abort(404);
        }

        $dataUpdate = [
            'namaKelas' => $request->namaKelas,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('img'), $namaFile);
            $dataUpdate['gambar'] = $namaFile;
        }

        DB::table('kelas')->where('idKelas', $id)->update($dataUpdate);

        DB::table('batch')->where('idKelas', $id)->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'harga' => $request->harga,
        ]);

        return redirect()->route('mentoring.index')->with('success', 'Kelas mentoring berhasil diperbarui.');
    }
}
