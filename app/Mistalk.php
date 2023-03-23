<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mistalk extends Model
{
    protected $table = 'data_mistalk';
    protected $fillable = [
        'id_akun', 'id_program', 'ttl', 'gender', 'domisili', 'instansi', 'tanya', 'metode_bayar', 'bukti_bayar'
    ];
    
    public $timestamps = false;
}
