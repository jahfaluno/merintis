<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
       
    protected $table = 'tbl_admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'username', 'password'
    ];
    
    protected $hidden = [
        'password'
    ];
    
    public $timestamps = false;
}
