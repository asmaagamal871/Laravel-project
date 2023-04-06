<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class EndUser extends User
{
    use HasFactory, HasRoles;

    protected $table = 'end_users';
    protected $guard_name = 'web';

    protected $fillable = [
        'DOB',
        'gender',
        'mobile_no',
        'avatar'
    ];
    public function type()
    {
        return $this->morphOne(User::class, 'typeable');
    }
    public function orders()
    {
        return $this->hasMany(Order::class)->onDelete('cascade');
    }
}
