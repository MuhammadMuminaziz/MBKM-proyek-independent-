<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['parmasi'];

    public function parmasi()
    {
        return $this->hasMany(Parmasi::class);
    }
    public function daftarObat()
    {
        return $this->hasMany(DaftarObat::class);
    }
}
