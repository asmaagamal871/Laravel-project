<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Pharmacy extends Model implements BannableContract
{
    use HasFactory,HasRoles,SoftDeletes,Bannable;
    
    protected $table = 'pharmacies';

    protected $guard_name ='web';

    protected $fillable = [
        
        'id',
        'national_id',
        'image',
        'area_id',
        'priority',
        'image_path',
    ];

    protected $dates = [
        'created_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'deleted_at'=>'datetime',
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


    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function getAvatarPathAttribute()
{
    return $this->avatar ? asset('storage/' . $this->avatar) : asset('img/default-avatar.png');
}



    /*public function banDoctor(Doctor $doctor)
    {
        if ($this->doctors->contains($doctor)) {
            $this->ban($doctor);
            $this->doctors()->detach($doctor);
        }
    }

    public function unbanDoctor(Doctor $doctor)
    {
        if ($this->bans->contains('model_id', $doctor->getKey())) {
            $this->unban($doctor);
        }
    }*/
    /*public function banDoctor(Doctor $doctor, $comment = null, $expiredAt = null)
    {
        $this->ban($doctor, $comment, $expiredAt);
    }

    public function unbanDoctor(Doctor $doctor)
    {
        $this->unban($doctor);
    }*/
}
