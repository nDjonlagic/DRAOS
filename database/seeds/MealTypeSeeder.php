<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            'Main meal',
            'Vegetarian/Vegan meal',
            'Drink',
            'Desert'
        ];

        foreach($data as $item) {
            DB::table('meal_types')
                ->insert([
                    'title' => $item
                ]);
        }
    }
}
