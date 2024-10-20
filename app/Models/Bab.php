<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\UjiKompetensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Bab extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function ujiKompetensis()
    {
        return $this->hasMany(UjiKompetensi::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

}
