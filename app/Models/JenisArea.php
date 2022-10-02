<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisArea extends Model
{
    protected $table = 'Jenis_area';

    protected $guarded = [];

    public $timestamps = false;

    public function area()
    {
        return $this->hasMany(Area::class);
    }
}
