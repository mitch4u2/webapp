<?php

use Illuminate\Database\Seeder;

class user_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 10)->create();
    }
}
