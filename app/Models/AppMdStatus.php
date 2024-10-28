<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMdStatus extends Model
{
    use HasFactory;

    protected $table = 'app_md_status';
    protected $primaryKey = 'id_status';
}
