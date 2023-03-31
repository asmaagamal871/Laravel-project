<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_insured',
        'delivery_address_id',
        'visa',
        'user_id',
        'pharmacy_id',
        'doctor_id'
    ];
    public function user()
    {
        return $this->belongsTo(EndUser::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
