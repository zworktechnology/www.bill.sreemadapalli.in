<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryboy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_key',
        'unique_key',
        'soft_delete',
        'name',
        'phone_number',
        'email',
        'password',
        'address',
        'delivery_area_id',
        'perdaysalary'
    ];

    public function deliveryarea()
    {
        return $this->belongsTo(Deliveryarea::class, 'delivery_area_id');
    }
}
