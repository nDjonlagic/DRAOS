<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // initilize types 
        $types = [];
        foreach(DB::table('meal_types')->get() as $item) {
            $types[] = $item->id;
        }

        $data = [
            [
                'name' => 'Hamburger',
                'type_id' => $types[0],
                'price' => 2.99,
                'image' => 'https://toppng.com/public/uploads/preview/hamburger-image-11526063744jnp10fcdc9.png'
            ],
            [
                'name' => 'Pizza',
                'type_id' => $types[0],
                'price' => 3.99,
                'image' => 'http://www.pngnames.com/files/4/Mushroom-Pizza-Png-Free-Download-1.png'
            ],
            [
                'name' => 'Doner',
                'type_id' => $types[0],
                'price' => 1.99,
                'image' => 'http://pngimg.com/uploads/kebab/kebab_PNG20.png'
            ],
            [
                'name' => 'Kebab',
                'type_id' => $types[0],
                'price' => 2.39,
                'image' => 'https://toppng.com/public/uploads/preview/kebab-11543585817f11jrlz57i.png'
            ],
            [
                'name' => 'Boorek',
                'type_id' => $types[0],
                'price' => 2.99,
                'image' => 'http://www.basburek.com/wp-content/uploads/2015/03/BBslide-1-2.png'
            ],
            [
                'name' => 'Baklava',
                'type_id' => $types[3],
                'price' => 2.99,
                'image' => 'http://www.rheintalerimbiss.ch/wp-content/uploads/2016/05/baklava1.png'
            ],
            [
                'name' => 'Zeljanica',
                'type_id' => $types[1],
                'price' => 2.99,
                'image' => 'http://www.basburek.com/wp-content/uploads/2015/03/BBslide-1-2.png'
            ],
            [
                'name' => 'Krompiruša',
                'type_id' => $types[1],
                'price' => 2.99,
                'image' => 'http://www.basburek.com/wp-content/uploads/2015/03/BBslide-1-2.png'
            ],
            [
                'name' => 'Coca-cola',
                'type_id' => $types[2],
                'price' => 0.99,
                'image' => 'http://purepng.com/public/uploads/large/purepng.com-coca-cola-cancoca-colacokecarbonated-soft-drinksoft-drinkcoke-can-1411527233281vvsqo.png'
            ],
            [
                'name' => 'Sprite',
                'type_id' => $types[2],
                'price' => 0.99,
                'image' => 'http://freepngdownload.com/image/thumb/sprite-png-free-download-10.png'
            ],
            [
                'name' => 'Water',
                'type_id' => $types[2],
                'price' => 0.49,
                'image' => 'http://pngimg.com/uploads/water/water_PNG50183.png'
            ]
        ];

        foreach($data as $item) {
            DB::table('meals')->insert($item);
        }
    }
}
