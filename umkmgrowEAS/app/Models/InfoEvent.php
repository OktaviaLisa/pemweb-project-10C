<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoEvent extends Model
{
    protected $table = 'infoevent';
    protected $primaryKey = 'idEvent';
    public $timestamps = false;

    protected $fillable = ['namaEvent', 'deskripsi', 'tanggal', 'lokasi', 'gambar'];
}