<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarObat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parmasi()
    {
        return $this->belongsTo(Parmasi::class);
    }
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
