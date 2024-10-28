<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdUser extends Model
{
    use HasFactory;

    protected $table = 'app_md_user';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name_user',
        'gelar_dpn',
        'gelar_blk',
        'login_user',
        'pswd',
        'level_user',
        'id_company',
        'id_branch',
        'nip_user',
        'id_golongan',
        'telp_user',
        'email_user',
        'id_jabatan',
        'id_instansi',
        'id_bidang',
        'id_bidangsub',
        'comt_user',
        'flag_del',
        'islogin',
        'dispmode',
        'filter1',
        'filter2',
        'filter3',
    ];

    protected $hidden = [
        'pswd', // Jika Anda ingin menyembunyikan field tertentu
    ];
}
