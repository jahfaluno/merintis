<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'data_proposal';
    protected $fillable = [
        'id_user','no_hp', 'tempat_lahir', 'tgl_lahir', 'kota_domisili', 'pekerjaan', 'jenis_kelamin', 'role', 'url_proposal', 'bidang_bisnis', 'metode_bayar', 'url_bukti_bayar'
    ];
    
    public $timestamps = false;
}
