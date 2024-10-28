<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdDatasurat extends Model
{
    use HasFactory;

    protected $table = 'app_md_datasurat';
    protected $primaryKey = 'id_datasurat';
}
