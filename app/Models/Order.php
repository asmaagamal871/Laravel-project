<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'status',
        'is_insured',
        'address_id',
        'visa',
        'user_id',
        'pharmacy_id',
        'doctor_id'
    ];
    public function endUser()
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
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
    public function orderMedicines()
    {
        return $this->hasMany(OrderMedicine::class);
    }
}
