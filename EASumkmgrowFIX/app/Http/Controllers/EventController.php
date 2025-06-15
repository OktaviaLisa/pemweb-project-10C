<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoEvent;

class EventController extends Controller
{
    public function index() {
        $data = InfoEvent::all();
        return view('event', compact('data'));
    }

    public function create() {
        return view('formevent', ['mode' => 'tambah']);
    }

    public function store(Request $request) {
        $request->validate([
            'namaEvent' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('gambar');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('img'), $fileName);

        InfoEvent::create([
            'namaEvent' => $request->namaEvent,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'gambar' => $fileName,
        ]);

        return redirect('/event'); //bagian ini itu yang bikin event di peserta sama kaya yang admin
    }

    public function edit($id) {
        $data = InfoEvent::findOrFail($id);
        return view('formevent', ['mode' => 'edit', 'data' => $data]);
    }

    public function update(Request $request, $id) {
        $data = InfoEvent::findOrFail($id);

        $request->validate([
            'namaEvent' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('img'), $fileName);
            $data->gambar = $fileName;
        }

        $data->namaEvent = $request->namaEvent;
        $data->deskripsi = $request->deskripsi;
        $data->tanggal = $request->tanggal;
        $data->lokasi = $request->lokasi;
        $data->save();

        return redirect('/event');
    }

    public function destroy($id) {
        InfoEvent::destroy($id);
        return redirect('/event');
    }
}