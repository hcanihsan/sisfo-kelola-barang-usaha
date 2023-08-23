<?php

namespace App\Models;

use App\Traits\rupiahFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    use rupiahFormat;
    
    protected $fillable =['nameproduct','category','quantity','priceperunit','imgproduct'];
    protected $table = 'product';

}
