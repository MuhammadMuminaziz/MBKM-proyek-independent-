<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function kartuRm()
    {
        return $this->belongsTo(KartuRm::class);
    }

    public function register()
    {
        return $this->hasMany(Register::class);
    }

    public function descPasien()
    {
        return $this->hasMany(DescPasien::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
