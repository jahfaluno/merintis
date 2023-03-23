<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lupapass extends Model
{
    protected $table = 'temp_akun';
    protected $fillable = [
        'email', 'temp_token'
    ];
    
    public $timestamps = false;
}
