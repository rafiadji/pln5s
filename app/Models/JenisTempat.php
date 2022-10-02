<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisTempat extends Model
{
    protected $table = 'Jenis_tempat';

    protected $guarded = [];

    public $timestamps = false;

    public function tempat()
    {
        return $this->hasMany(Tempat::class);
    }
}
