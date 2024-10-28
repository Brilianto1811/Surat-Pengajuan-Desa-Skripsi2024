<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AppMdDesauser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'app_md_desauser';
    protected $primaryKey = 'id_desauser';

    // Tentukan kolom yang dapat diisi secara massal
    // protected $fillable = [
    //     'id_kec',
    //     'id_kel',
    //     'mode_desauser',
    //     'name_desauser',
    //     'user_name',
    //     'user_pass',
    //     'str_pswd_hsh',
    //     'str_foto',
    //     'id_desausertype',
    //     'id_desauserstatus',
    //     'nik_desauser',
    //     'nohp_desauser',
    //     'id_user',
    //     'tgl_data',
    //     'flag_del',
    // ];

    // Tentukan kolom yang diubah menjadi tipe data tertentu
    protected $casts = [
        'tgl_data' => 'datetime',
    ];

    // protected $hidden = [
    //     'str_pswd_hsh',
    // ];

    public function getAuthPassword()
    {
        return $this->str_pswd_hsh;
    }

    public function getUserLoginAttribute()
    {
        $user = null;
        if (auth()->guard('adminaplikasi')->check()) {
            $user = auth()->guard('adminaplikasi')->user();
        }
        if (auth()->guard('user')->check()) {
            $user = auth()->guard('user')->user();
        }
        if (auth()->guard('operatordesa')->check()) {
            $user = auth()->guard('operatordesa')->user();
        }
        return $user;
    }
}
