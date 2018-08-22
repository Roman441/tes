<?php
/**
 * @author Komlev.R
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currencys extends Model
{
    ## объявляю связь один-ко-многим с моделью accumulations	
    public function accumulations() 
    {
        return $this->hasMany(Accumulations::class, 'currency_id');
    }
}
