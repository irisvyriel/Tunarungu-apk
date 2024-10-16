<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['nama'];


    public function siswas() {
        return $this->hasMany(Siswa::class);
    }
}
