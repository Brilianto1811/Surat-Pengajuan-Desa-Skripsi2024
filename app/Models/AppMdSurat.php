<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdSurat extends Model
{
    use HasFactory;

    protected $table = 'app_md_surat';
    protected $primaryKey = 'id_surat';
}
