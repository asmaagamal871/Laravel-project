<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Admin extends User
{
    use HasFactory, HasRoles;
    
    protected $table = 'admins';
    protected $guard_name = 'admin';

    public function type()
    {
        return $this->morphOne(User::class,'typeable');
    }
}