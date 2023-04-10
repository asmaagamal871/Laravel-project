<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';

    protected $fillable = [
        'st_name',
        'building_no',
        'floor_no',
        'flat_no',
        'is_main',
        'area_id',
        'end_user_id'
    ];
    public function end_user()
    {
        return $this->belongsTo(EndUser::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function type()
    {
        return $this->morphOne(User::class, 'typeable');
    }
}
