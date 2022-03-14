<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['uid','country'];

    public function user(){
        return $this->belongsTo(User::class, 'uid');
    }
    
    public function addresses(){
        return $this->hasMany(Address::class, 'uid');
    }
}
