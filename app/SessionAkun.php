<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionAkun extends Model
{
    protected $table = 'session_akun';
    protected $fillable = [
        'id_akun', 'token'
    ];
    
    public $timestamps = false;

}
