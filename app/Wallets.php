<?php
/**
 * @author Komlev.R
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    ## объявляю связь один-ко-многим с моделью accumulations
    public function accumulations() 
    {
        return $this->hasMany(Accumulations::class, 'wallet_id');
    }
}
