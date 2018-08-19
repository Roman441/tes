<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Accumulations extends Model
{
    public function wallets() 
    {
        return $this->belongsTo(Wallets::class, 'wallet_id');
    }

    public function currencys() 
    {
        return $this->belongsTo(Currencys::class, 'currency_id');
    }

    protected $fillable = ['summ'];
}
