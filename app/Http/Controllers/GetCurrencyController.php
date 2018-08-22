<?php
/**
 * @author Komlev.R
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetCurrencyController extends Controller
{
    /**
     * @param accepting value
     */
    public $type = "";
 
    /**
     * @param string $type to input
     * @return exchange rate values
     */
    public function getAll()
    {
        if (@fopen("http://www.cbr.ru/scripts/XML_daily.asp", "r")){       

            $xml = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");
        
            ## итерируюсь по телу ответа и ищу значения совпадающие с принятыми
            foreach ($xml->Valute as $lang) {
                if ($lang->CharCode == $this->type){
                    return  $lang->Value;
                }
            }
        } else {
            exit('сервис http://www.cbr.ru/scripts/XML_daily.asp не доступен');
        }
    }
}
