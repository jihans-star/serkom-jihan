<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'prestasis';

    protected $fillable = [
        'nama_prestasi',
        'kategori',
        'tingkat',
        'nama_peraih',
        'tanggal_perolehan',
        'deskripsi',
        'gambar',
    ];

    protected $casts = [
        'tanggal_perolehan' => 'date',
    ];
}
