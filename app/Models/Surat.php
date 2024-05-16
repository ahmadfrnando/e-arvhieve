<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = [
    //     'nosurat',
    //     'hal',
    //     'iddinas',
    //     'tglsurat',
    //     'surat',
    //     'berkassurat',
    //     'status'
    // ];

    protected $casts = [
        'berkassurat' => 'array'
    ];
}