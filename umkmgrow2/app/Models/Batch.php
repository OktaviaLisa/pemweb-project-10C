<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batch';
    protected $primaryKey = 'idBatch';
    public $timestamps = false;

    protected $fillable = [
        'idKelas',
        'tanggal',
        'harga',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idKelas', 'idKelas');
    }
}