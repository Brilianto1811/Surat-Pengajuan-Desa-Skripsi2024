<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdDesauserstatus extends Model
{
    use HasFactory;

    protected $table = 'app_md_desauserstatus';
    protected $primaryKey = 'id_desauserstatus';

    protected $fillable = [
        'name_desauserstatus',
        'comt_desauserstatus',
        'id_user',
        'tgl_data',
        'flag_del',
    ];

    protected $casts = [
        'tgl_data' => 'datetime',
    ];
}
