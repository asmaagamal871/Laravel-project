<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMedicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'medicine_id',
        'qty',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function medicine()
    {
        return $this->hasMany(Medicine::class);
    }
}
