<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasubag extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class);
    }
    public function surats(){
        return $this->hasMany(Surat::class);
    }
}
