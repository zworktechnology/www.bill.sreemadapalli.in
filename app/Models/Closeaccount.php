<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Closeaccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'date',
        'sales',
        'cash',
        'card',
        'paytm_business',
        'paytm',
        'phonepe_business',
        'phonepe',
        'gpay_business',
        'gpay',
    ];
}
