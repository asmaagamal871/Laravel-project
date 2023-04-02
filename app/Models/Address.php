<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable=[
        'st_name',
        'building_no',
        'floor_no',
        'flat_no',
        'is_main',
        'area_id',
        'user_id'

    ];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Area(){
        return $this->belongsTo(Area::class);
    }

}
