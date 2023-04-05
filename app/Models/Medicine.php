<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Medicine extends Model
{
    use HasFactory,HasRoles;
    protected $table = 'medicines';

    protected $fillable=[
        'name',
        'type',
        'price'
    ];
    public function user()
    {
        return $this->belongsTo(EndUser::class);
    }
 
    public function orderMedicines()
    {
        return $this->hasMany(OrderMedicine::class)->onDelete('cascade');
    }
}
