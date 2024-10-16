<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = ['kelas_id', 'nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'nis', 'password'];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
