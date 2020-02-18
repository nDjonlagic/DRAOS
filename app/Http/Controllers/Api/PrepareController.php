<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\OrderService;

use Auth;

class PrepareController extends Controller 
{
  public function __construct() 
  {
    $this->middleware('auth.api');
  }

  public function take(OrderService $orderService) 
  {
    // fetch the order
    $order = $orderService->next();
    $user = Auth::user();

    // set the order as in preapratiin
    $orderService->take($order, $user);

    // return the order as presonse 
    return response()->json([
      'order' => $order,
      'order_items' => $order->items->load('meal')
    ], 200);
  }

  public function finish(Request $request, OrderService $orderService)
  {
    // fetch the id
    $id = $request->get('id');

    // fetch the order 
    $order = $orderService->get($id);

    // set the order as preparaed 
    $orderService->finish($order);

    // return the order as response 
    return response()->json([
      $order->with('status')
    ], 200);
  }
}