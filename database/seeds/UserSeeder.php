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
        //
        DB::table('users')->insert([
        'name' => 'NedimCustomer',
        'email' => 'ndonlagic1@etf.unsa.ba',
        'password' => bcrypt('customer'),
        'role' => 'customer'
    ]);
        DB::table('users')->insert([
            'name' => 'NedimStaff',
            'email' => 'ndjonlagic1@gmail.com',
            'password' => bcrypt('staff'),
            'role' => 'staff'
        ]);
    }
}
