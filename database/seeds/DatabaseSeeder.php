<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencys')->insert([

            [
                'type' => 'RUB',
            ],
            [
                'type' => 'KGS',
            ],
            [
                'type' => 'USD',
            ],
            [
                'type' => 'EUR',
            ]
        ]);

        DB::table('wallets')->insert([
            'name' => 'first',
        ]);

        DB::table('accumulations')->insert([
 
            [
                'currency_id' => 1,
                'wallet_id' => 1,
                'summ' => 0,
            ],
            [
                'currency_id' => 2,
                'wallet_id' => 1,
                'summ' => 0,
            ],
            [
                'currency_id' => 3,
                'wallet_id' => 1,
                'summ' => 0,
            ],
            [
                'currency_id' => 4,
                'wallet_id' => 1,
                'summ' => 0,
            ] 
        ]);
    }
}
