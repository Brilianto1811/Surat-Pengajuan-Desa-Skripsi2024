<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppDatTrans extends Model
{
    use HasFactory;

    protected $table = 'app_dat_trans';
    protected $primaryKey = 'id_trans';

    protected $fillable = [
        'id_kec',
        'id_kel',
        'tgl_trans',
        'nik_trans_req',
        'nik_trans_srt',
        'id_surat',
        'note_req',
        'comt_trans',
        'tgl_mulai',
        'tgl_akhir',
        'no_surat',
        'tgl_surat',
        'str_ttd',
        'str_wni',
        'id_status',
        'note_status',
        'nama_warga',
        'id_user',
        'tgl_data',
        'flag_del',
    ];

    protected $casts = [
        'tgl_trans' => 'datetime',
        'tgl_mulai' => 'datetime',
        'tgl_akhir' => 'datetime',
        'tgl_surat' => 'datetime',
        'tgl_data' => 'datetime',
    ];
}
