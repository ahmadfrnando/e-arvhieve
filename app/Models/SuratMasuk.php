<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'file' => 'array',
    ];

    public function dinas()
    {
        return $this->belongsTo(Dinas::class);
    }

    public function setContentAttribute($value)
    {
        if (! auth()->user()->isAdmin) {
            return;
        }
 
        $this->attributes['status'] = $value;
    }
}