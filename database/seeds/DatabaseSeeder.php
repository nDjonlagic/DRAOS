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
        $this->call(MealTypeSeeder::class);
        $this->call(MealSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
