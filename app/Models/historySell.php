<?php

namespace App\Models;

use App\Traits\rupiahFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historySell extends Model
{
    use HasFactory;
    use rupiahFormat;
    
    protected $fillable =['nameproduct','category','quantity','totalprice','imgproduct'];
    protected $table = 'history_sells';
}
