<?php

namespace App\Models;

use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cog\Contracts\Ban\Bannable as BannableInterface;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class Doctor extends user implements BannableInterface
{
    use HasFactory,HasRoles;
    
     protected $table = 'doctors';

    protected $fillable = [
        
        'national_id',
        'avatar', 
        'is_baned',
        'created_at'

       ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function type()
    {
        return $this->morphOne(User::class, 'typeable');
    }

    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
    public function getAvatarPathAttribute()
{
    return $this->avatar ? asset('storage/' . $this->avatar) : asset('img/default-avatar.png');
}






}

