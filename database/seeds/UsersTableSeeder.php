<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => Str::random(10),
            'email' => 'conta_um@gmail.com',
            'password' => bcrypt('secret'),
            'agency' => 1,
            'account' => 1,
            'balance' => 1000
        ]);

        User::create([
            'name' => Str::random(10),
            'email' => 'conta_dois@gmail.com',
            'password' => bcrypt('secret'),
            'agency' => 1,
            'account' => 2,
            'balance' => 200
        ]);

        User::create([
            'name' => Str::random(10),
            'email' => 'conta_tres@gmail.com',
            'password' => bcrypt('secret'),
            'agency' => 2,
            'account' => 3,
            'balance' => 600
        ]);
    }
}
