<?php
/**
 * @author Komlev.R
 */


namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Wallets;
use App\Http\Controllers\GetCurrencyController;

class GetWallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:wallet {name}';

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
     * @param string $name string to input
     * @return value of wallets state
     */
    public function handle()
    {
        $obj = new GetCurrencyController();

        $wallet = Wallets::where('name', $this->argument('name'))->first();
        if (isset($wallet)) 
        {  
            $accumulat = $wallet->accumulations;
 
            $headers = ['Type', 'Summ in RUB', 'Summ in other currency'];
            $body = array();

            foreach($accumulat as $k){
                $cur = $k->currencys;

                if ($cur["type"] != "RUB"){
                    $obj->type = $cur["type"];
                    $sus = $k["summ"] * ($obj->getAll());
                } else {
                    $sus = $k["summ"];
                }
                array_push($body, (array($cur["type"],  $sus, $k["summ"])));
            }
            $this->table($headers, $body);
        } else {
            $this->error('Такого кошелька не существует!');
        }
    }
}
