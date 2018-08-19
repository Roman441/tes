<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Currencys extends Model
{
    public function accumulations() 
    {
        return $this->hasMany(Accumulations::class, 'currency_id');
    }

    protected $fillable = ['title', 'body'];
}
