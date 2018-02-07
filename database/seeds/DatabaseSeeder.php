<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'asantha',
            'email' => 'asanthathilina@gmail.com',
            'password' => bcrypt('asantha123')
        ]);
    }
}

