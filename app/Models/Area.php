<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class Area extends Model
{
    
    protected $table = 'areas';
    protected $fillable = [
        'name',
        'id'

    ];



public function address()
{
    return $this->hasMany(Address::class);
    
    
}


}   

