<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'infoevent';         // Nama tabel di database
    protected $primaryKey = 'idEvent';  // Primary key-nya bukan 'id', tapi 'idEvent'
    public $timestamps = false;         // soalnya gaada created_at dan updated_at

    protected $fillable = [
        'namaEvent',
        'deskripsi',
        'tanggal',
        'lokasi',
        'gambar',
    ];
}
