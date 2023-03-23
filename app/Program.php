<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'data_program';
    protected $fillable = [
        'nama_program', 'nama_kegiatan', 'link_pamflet', 'link_daftar', 'desc_program', 'sasaran_program', 'perlengkapan', 'mentor', 'profesi', 'link_cv', 'metode_pelaksanaan', 'link_map', 'tgl_mulai', 'tgl_selesai', 'jam_mulai', 'jam_selesai', 'biaya', 'harga_normal', 'harga_promo', 'link_jadwal', 'link_dokumentasi', 'status'
    ];

    public $timestamps = false;
}
