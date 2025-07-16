<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message', 
        'target',
        'gambar'
    ];

   public function donaturs()
{
    return $this->hasMany(\App\Models\Donatur::class);
}


    public function getTotalTerkumpulAttribute()
    {
        return $this->donaturs()->sum('total_donasi');
    }
}
