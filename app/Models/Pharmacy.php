<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Pharmacy extends User
{
    use HasFactory,HasRoles;
    
    protected $table = 'pharmacies';

    protected $fillable = [
        'name',
        'email',
        'password',
        'priority',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function type()
    {
        return $this->morphOne(User::class,'typeable');
    }
    public function orders()
    {
        return $this->hasMany(Order::class)->onDelete('cascade');
    }
}
