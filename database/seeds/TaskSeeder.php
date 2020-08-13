<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('tasks')->insert([
            'name' => 'first task',
            'status_id' => 1,
            'created_by_id' => 1,
            'assigned_to_id' => 2,
            'created_at' => 1111111,
            'updated_at' => 1111111
        ]);
    }
}
