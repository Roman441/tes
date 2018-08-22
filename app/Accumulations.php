<?php
/**
 * @author Komlev.R
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accumulations extends Model
{
    public $timestamps = false;

    ## объявляю связь один-ко-многим с моделью wallaelts
    public function wallets() 
    {
        return $this->belongsTo(Wallets::class, 'wallet_id');
    }

    ## объявляю связь один-ко-многим с моделью currencys
    public function currencys() 
    {
        return $this->belongsTo(Currencys::class, 'currency_id');
    }

    protected $fillable = ['summ'];
}
