<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
        	'currency' => 2,
        	'quantity' => 5,
        ]);

        Currency::create([
        	'currency' => 5,
        	'quantity' => 5,
        ]);

        Currency::create([
        	'currency' => 10,
        	'quantity' => 5,
        ]);

        Currency::create([
        	'currency' => 20,
        	'quantity' => 5,
        ]);

        Currency::create([
        	'currency' => 50,
        	'quantity' => 5,
        ]);

        Currency::create([
        	'currency' => 100,
        	'quantity' => 5,
        ]);
    }
}
