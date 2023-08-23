<?php

namespace App\Traits;

trait rupiahFormat 
{
    function rupiahFormat($field, $prefix = null){

        $prefix = $prefix ? $prefix : 'Rp ';
        $amount = $this->attributes[$field];
        return $prefix . number_format($amount, 0, ',', '.');
    }
}
?>