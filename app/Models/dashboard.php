<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dashboard extends Model
{
    use HasFactory;

    protected $fillable = ['content','owner','id_user'];
    protected $table = 'dashboard';
}
