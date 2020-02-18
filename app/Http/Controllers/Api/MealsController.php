<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\MealService;

class MealsController extends Controller 
{
  /**
   * Fetch the list off categories 
   *
   * @param MealService $mealService
   */
  public function categories(MealService $mealService)
  {
    return response()->json($mealService->categories(), 200);
  }

  /**
   * Fetch meals from a speicifc category 
   *
   * @param Integer $type 
   * @param MealService $mealService
   */
  public function meals($type, $id, MealService $mealService)
  {
    return ($type != null)
           ? response()->json($mealService->meals($type, $id), 200)
           : response()->json(['message' => 'No meal type set.'], 400);
  }
}
