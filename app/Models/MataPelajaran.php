<?php

namespace App\Models;

use App\Models\Bab;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $fillable = ['nama'];

    public function babs() {
        return $this->hasMany(Bab::class);
    }
}
