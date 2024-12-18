<?php

namespace App\Models;

use App\Models\Bab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class MataPelajaran extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function babs()
    {
        return $this->hasMany(Bab::class);
    }

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
}
