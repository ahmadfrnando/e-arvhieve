<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinas extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function suratmasuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }
    
    public function suratkeluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }
}