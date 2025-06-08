<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasKeranjang extends Model
{
    protected $table = 'kelaskeranjang';

    protected $fillable = [
        'email',
        'kelas_id',
        'batch_id',
        'metode_pembayaran',
        'kode_va',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'idKelas');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'idbatch');
    }
}