<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salespayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'soft_delete',
        'customer_id',
        'bank_id',
        'date',
        'time',
        'paid_amount',
        'salespayment_note'
        // 'deliveryplan_id'
    ];
}
