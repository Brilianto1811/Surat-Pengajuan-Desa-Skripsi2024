<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdKel extends Model
{
    use HasFactory;

    protected $table = 'app_md_kel';
    protected $primaryKey = 'id_kel';

    protected $fillable = [
        'id_kec',
        'name_kel',
        'code_kel',
        'comt_kel',
        'tgl_data',
        'id_user',
        'flag_del',
    ];

    protected $casts = [
        'tgl_data' => 'datetime',
    ];
}
