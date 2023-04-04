<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends User
{
    use HasFactory,HasRoles;
    
    // protected $table = 'doctors';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function type()
    {
        return $this->morphOne(User::class,'typeable');
    }
}
