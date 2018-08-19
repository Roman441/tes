<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Wallets;
use App\Http\Controllers\GetCurrencyController;

class TransactionsWallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:wallet {currency}';

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
        $obj = new GetCurrencyController();

        $wallet = Wallets::where('name', $this->argument('currency'))->first();
        $headers = ['Type', 'Summ'];
        $accumulat = $wallet->accumulations;
        $body = array();

        foreach($accumulat as $k){
            $cur = $k->currencys;

            if ($cur["type"] != "RUB"){
                $obj->type = $cur["type"];
                $sus = $k["summ"] * ($obj->get());
            } else {
                $sus = $k["summ"];
            }
                array_push($body, (array($cur["type"],  $sus)));
        }
          $this->table($headers, $body);
    }
}
