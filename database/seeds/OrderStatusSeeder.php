<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
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
           'Aborted order',
           'Selecting items',
           'Ready to pay',
           'Paying at the counter',
           'Queueud for preparation',
           'Preparing order',
           'Order ready'
        ];

        foreach($data as $item) {
            DB::table('order_status')
                ->insert([
                    'title' => $item
                ]);
        }
    }
}
