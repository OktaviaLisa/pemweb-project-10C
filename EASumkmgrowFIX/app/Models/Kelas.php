<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'idKelas';
    public $timestamps = false;

    protected $fillable = [
        'namaKelas',
        'deskripsi',
        'gambar',
        'jenis',
    ];

    // Ambil satu batch terbaru berdasarkan tanggal
   public function batch()
    {
    return $this->hasOne(Batch::class, 'idKelas', 'idKelas')->latestOfMany('tanggal_mulai');
    }

}