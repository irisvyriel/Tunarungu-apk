<?php

namespace App\Models;

use App\Models\Bab;
use Illuminate\Database\Eloquent\Model;

class UjiKompetensi extends Model
{
    protected $fillable = ['bab_id', 'soal', 'tipe', 'data'];

    public function UjiKompetensi() {
        return $this->belongsTo(Bab::class);
    }
}
