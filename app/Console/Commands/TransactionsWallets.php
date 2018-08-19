<?php

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $headers = ['Type', 'Summ in RUB', "Summ in {$this->argument('type_currency')}"];
        $typeCurrency = Currencys::where('type', $this->argument('type_currency'))->first();
        $w = $typeCurrency->accumulations->first();
        $body = array();
      
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
    }
}
