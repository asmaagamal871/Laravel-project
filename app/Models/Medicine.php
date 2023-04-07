<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Medicine extends Model
{
    use HasFactory,HasRoles;
    protected $fillable=[
        'name',
        'type',
        'price'
    ];
    public function user()
    {
        return $this->belongsTo(EndUser::class);
    }
 
    protected $table = 'medicines';
    protected function price():Attribute
    {return Attribute::make(


        get: fn (int $value)=>($value / 100),
        set: fn (int $value)=>($value * 100),

    );

    }

}
