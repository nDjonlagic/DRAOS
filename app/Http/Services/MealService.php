<?php

namespace App\Services;

use App\Meal;
use App\MealType;
use App\OrderItem;

class MealService 
{
  /**
   * Find all categories 
   * 
   */
  public function categories()
  {
    return MealType::all();
  }

  /**
   * Find meals by meal type  
   *
   * @param Integr $type
   */
  public function meals($type, $id)
  {
    $meals = Meal::where('type_id', $type)->get();

    $data = [];

    foreach($meals as $key => $item) {
      $data[$key]['id'] = $item->id;
      $data[$key]['name'] = $item->name;
      $data[$key]['price'] = $item->price;
      $data[$key]['type_id'] = $item->type_id;
      $data[$key]['image'] = $item->image;
      $data[$key]['quantity'] = (OrderItem::where('orders_id', $id)->where('meals_id', $item->id)->exists())
                            ? OrderItem::where('orders_id', $id)->where('meals_id', $item->id)->first()->quantity
                            : 0;
    }

    return $data;
  }

}