<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    protected $table = 'tempat';

    protected $guarded = [];

    public $timestamps = false;
    
    public function jenisTempat()
    {
        return $this->belongsTo(JenisTempat::class, 'jenisId');
    }
}
