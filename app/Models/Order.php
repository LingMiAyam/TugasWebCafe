<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'nomor_meja',
        'items',
        'total_harga',
        'status',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
