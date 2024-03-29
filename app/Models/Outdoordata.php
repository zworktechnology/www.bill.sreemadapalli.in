<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outdoordata extends Model
{
    use HasFactory;

    protected $fillable = [
        'outdoor_id',
        'outdoor_product',
        'quantity',
        'price_per_quantity',
        'price',
        'outdoornote'
    ];
}
