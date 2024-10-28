<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdProv extends Model
{
    use HasFactory;

    protected $table = 'app_md_prov';
    protected $primaryKey = 'id_prov';
}
