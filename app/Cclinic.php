<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cclinic extends Model
{
    protected $table = 'data_cclinic';
    protected $fillable = [
        'id_akun', 'id_program', 'ttl', 'domisili', 'ide_bisnis', 'bidang_bisnis', 'masalah', 'solusi', 'target', 'kebutuhan', 'metode_bayar', 'bukti_bayar'
    ];

    public $timestamps = false;
}
