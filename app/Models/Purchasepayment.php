<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasepayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'soft_delete',
        'supplier_id',
        'bank_id',
        'date',
        'time',
        'paid_amount',
        'purchasepayment_note'
    ];
}
