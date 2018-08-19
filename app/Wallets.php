<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Wallets extends Model
{
    public function accumulations() 
    {
        return $this->hasMany(Accumulations::class, 'wallet_id');
    }

    protected $fillable = ['title', 'body'];
}
