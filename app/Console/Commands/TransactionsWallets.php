<?php
/**
 * @author Komlev.R
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Wallets;
use App\Currencys;
use App\Accumulations;
use App\Http\Controllers\GetCurrencyController;

class TransactionsWallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:wallet {currency} {type_operation} {numeral} {type_currency}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * @param string $currency, $type_operation, $numeralm, $type_currency string to input
    * @return resault result of operation
    */
    public function handle()
    {
        
        $typeCurrency = Currencys::where('type', $this->argument('type_currency'))->first();
        if (isset($typeCurrency))
        {
            $w = $typeCurrency->accumulations->first();
            $body = array();
            $headers = ['Type', 'Summ in RUB', "Summ in {$this->argument('type_currency')}"];
      
            switch ($this->argument('type_operation')) {
                case '+':
                    $newSum = $w["summ"] + $this->argument('numeral');
                    Accumulations::find($w["id"])->update(['summ' => $newSum]);
                    $this->error($newSum);
                    break;
                case '-':
                    $newSum = $w["summ"] - $this->argument('numeral');
                    if ($newSum < 0) {
                        $newSum = $w["summ"];
                        $this->error('Оперция не может быть выполнена!');
                    } else {
                        Accumulations::find($w["id"])->update(['summ' => $newSum]);
                    }
                    break;
            } 
        } else {
            $this->error('такая валюта не зарегистрирована!');
        }
    } 
}
