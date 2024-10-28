<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdSuratcat extends Model
{
    use HasFactory;

    protected $table = 'app_md_suratcat';
    protected $primaryKey = 'id_suratcat';
}
