<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'Area';

    protected $guarded = [];

    public $timestamps = false;
    
    public function jenisArea()
    {
        return $this->belongsTo(JenisArea::class, 'jenisId');
    }
}
