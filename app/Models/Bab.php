<?php

namespace App\Models;

use App\Models\MataPelajaran;
use App\Models\UjiKompetensi;
use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    protected $fillable = ['mata_pelajaran_id', 'kode', 'nama'];

    public function mataPelajaran() {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function ujiKompetensis() {
        return $this->hasMany(UjiKompetensi::class);
    }

}

