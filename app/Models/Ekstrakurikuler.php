<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Ekstrakurikuler extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'ekstrakurikulers';

    protected $fillable = [
        'nama_eskul',
        'slug',
        'pembina',
        'jadwal_latihan',
        'deskripsi',
        'gambar',
    ];
}
