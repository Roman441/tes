<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Wallets;
use App\Http\Controllers\GetCurrencyController;

class GetWalletsConversion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:walletConversion {currency} {type}';

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
        $obj->type = $this->argument('type');
        $sus = $obj->getAll();


        $wallet = Wallets::where('name', $this->argument('currency'))->first();
        $headers = ['Type', 'Summ in RUB', "Summ in {$this->argument('type')}"];
        $accumulat = $wallet->accumulations;
        $body = array();

        foreach($accumulat as $k){
            $cur = $k->currencys;

            if ($cur["type"] != "RUB"){
                $susd = $k["summ"] * $sus;
            } else {
                $susd = $k["summ"];
            }
                array_push($body, (array($cur["type"], $k["summ"], $susd)));
        }
          $this->table($headers, $body);
    }
}
