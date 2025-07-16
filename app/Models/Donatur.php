<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'pesan',
        'total_donasi',
        'tipe_bayar',
        'donation_id',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
