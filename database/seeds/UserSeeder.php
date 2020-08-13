<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('users')->insert([
            'id' => 1,
            'name' => 'First',
            'email' => 'mmmm1@gmail.com',
            'password' => 'ddddd'
        ]);
        Db::table('users')->insert([
            'id' => 2,
            'name' => 'Second',
            'email' => 'mmmm2@gmail.com',
            'password' => 'ddddd'
        ]);

    }
}
