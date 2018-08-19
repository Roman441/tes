<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class GetCurrencyController extends Controller
{
    public $type = "";

    public function getAll()
    {
    
        $xml = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");
       
        foreach ($xml->Valute as $lang) {
            if ($lang->CharCode == $this->type){
                return  $lang->Value;
            }
        }
    }
 
    public function getOnce()
    {

        $xml = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");

        foreach ($xml->Valute as $lang) {
            if ($lang->CharCode == $this->type){
                return  $lang->Value;
            }
        }
    }
}
