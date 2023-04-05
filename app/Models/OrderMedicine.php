<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class OrderMedicine extends Model
{
    use HasFactory,HasRoles ;
    protected $table = 'order_include_medicine';

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
