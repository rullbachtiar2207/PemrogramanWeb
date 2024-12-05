<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
    ];

    // Menambahkan accessor untuk gambar agar menghasilkan URL lengkap
    protected function gambar(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn ($gambar) => url('/storage/portofolios/' . $gambar)
        );
    }
}
