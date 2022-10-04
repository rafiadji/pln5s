<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'Transaksi';

    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'penilaianId');
    }

    public function tempat()
    {
        return $this->belongsTo(Tempat::class, 'tempatId');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'areaId');
    }
}
