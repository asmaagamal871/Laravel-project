<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Prescription extends Model
{
    use HasFactory,HasRoles ;

    protected $fillable = [
        'order_id',
        'prescription'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
