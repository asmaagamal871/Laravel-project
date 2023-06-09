<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class EndUser extends User
{
    use HasFactory;
    use HasRoles;

    protected $table = 'end_users';
    protected $guard_name = 'web';

    protected $fillable = [
        'DOB',
        'gender',
        'mobile_no',
        'image',
        'national_id',
    ];
    public function type()
    {
        return $this->morphOne(User::class, 'typeable');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);

    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
