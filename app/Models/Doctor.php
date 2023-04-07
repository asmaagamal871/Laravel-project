<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class Doctor extends User
{


    
    protected $guard_name = 'web';
    
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





}

