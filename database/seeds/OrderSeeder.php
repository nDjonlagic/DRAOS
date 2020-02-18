<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Meal;
use App\Order;
use App\OrderItem;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // fetch the oprepare order 
        $status = DB::table('order_status')
                    ->where('title', 'Queueud for preparation')
                    ->first();

        // create few orders first 
        $orders = [];

        for($i = 0; $i < 5; $i++) {
            // input orders 
            $orders[] = Order::create([
                'users_id' => User::inRandomOrder()->first()->id,
                'status_id' => $status->id,
                'archived' => false
            ]);
            
            sleep(2);
        }
    
        // add order items for each order 
        foreach($orders as $order) {
            for($i = 0; $i < rand(2, 10); $i++) {
                $order->items()->create([
                    'meals_id' => Meal::inRandomOrder()->first()->id,
                    'quantity' => rand(1, 3)
                ]);
            }
        }
    }
}
