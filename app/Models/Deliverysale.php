<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverysale extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'date',
        'time',
        'deliveryboyid',
        'customer_id',
        'delivery_status',
        'session_id',
        'month',
        'year'
    ];
}
