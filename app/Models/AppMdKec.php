<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdKec extends Model
{
    use HasFactory;

    protected $table = 'app_md_kec';
    protected $primaryKey = 'id_kec';

    protected $fillable = [
        'id_kab',
        'name_kec',
        'code_kec',
        'id_user',
        'tgl_data',
        'flag_del',
        'name_upt',
        'cibraya',
    ];

    protected $casts = [
        'tgl_data' => 'datetime',
    ];
}
