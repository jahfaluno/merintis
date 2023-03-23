<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'tbl_finalis50';
    protected $fillable = [
        'id_akun', 'nama_bisnis', 'link_yt'
    ];
    protected $primaryKey = 'id_finalis';
    
    public $timestamps = false;
}
