<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAkun extends Authenticatable
{
    use Notifiable;

    protected $table = 'user_akun';
    protected $fillable = [
        'nm_lengkap', 'email', 'no_hp','password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps = false;

    public function scopeCekemail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeCekdata($query, $id)
    {
        return $query->where('id', $id);
    }
}
