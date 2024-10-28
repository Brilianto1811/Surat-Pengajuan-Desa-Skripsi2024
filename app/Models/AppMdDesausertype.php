<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdDesausertype extends Model
{
    use HasFactory;

    protected $table = 'app_md_desausertype';
    protected $primaryKey = 'id_desausertype';

    protected $fillable = [
        'name_desausertype',
        'comt_desausertype',
        'id_user',
        'tgl_data',
        'flag_del',
    ];

    protected $casts = [
        'tgl_data' => 'datetime',
    ];
}
